<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
class ProduitFrontendController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $query = Product::with(['category', 'images'])
            ->withCount('likes')
            ->when($userId, function ($q) use ($userId) {
                $q->withExists([
                    'likes as liked' => function ($likeQuery) use ($userId) {
                        $likeQuery->where('user_id', $userId);
                    }
                ]);
            });


        // 🔍 Filtre recherche
        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        // 🏷️ Filtre catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // ⏰ Tri du plus récent
        $query->orderBy('created_at', 'desc');

        // ⚡ Récupération produits optimisée
        $products = $query->get();

        // 🧩 Récupération des catégories
        $categories = Category::all();

        return Inertia::render('backend/products/ProductIndex', [
            'products' => $products,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category']),
            'auth' => ['user' => auth()->user()],
            'seo' => [
                'title' => 'Boris Tech e-commerce - Marketplace d’ordinateurs, smartphones et accessoires au Cameroun',
                'description' => 'Boris Tech, votre marketplace à Bafoussam et Yaoundé : achetez ordinateurs portables, PC, smartphones et accessoires informatiques de qualité au meilleur prix.',
                'image' => asset('boristech.jpg'),
                'url' => url('/'),
                'robots' => 'index, follow',
            ],
        ]);
    }











    public function showBySlug($slug)
    {
        $product = Product::with('images', 'category', 'descriptionProduct')
            ->where('slug', $slug)
            ->firstOrFail();


        // 🔥 Incrémenter la vue ici !
        $this->incrementProductView($product);

        // Transformer le modèle en tableau et la relation descriptionProduct aussi
        $productArray = $product->toArray();

        // Si descriptionProduct existe, garder le contenu, sinon null
        $productArray['descriptionProduct'] = $product->descriptionProduct
            ? $product->descriptionProduct->toArray()
            : null;

        // Produits similaires
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(10)
            ->get()
            ->toArray(); // transformer en tableau

        return Inertia::render('backend/products/ProductDetail', [
            'product' => $productArray,
            'similarProducts' => $similarProducts,
            'auth' => [
                'user' => auth()->user(),
            ],
        ]);
    }

    /**
     * Incrémenter la vue du produit si pas déjà vu (session + IP)
     */
    private function incrementProductView($product)
    {
        $key = 'viewed:' . $product->id . ':' . session()->getId();
        $ipKey = 'viewed_ip:' . $product->id . ':' . request()->ip();

        $hasViewed = Cache::has($key) || Cache::has($ipKey);

        if (!$hasViewed) {
            // Marquer comme vu pendant 24h
            Cache::put($key, true, now()->addHours(24));
            Cache::put($ipKey, true, now()->addHours(24));

            // 🔼 Incrémenter le compteur réel
            $product->increment('views_count');
        }
    }

}
