<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

class BlogFrontendController extends Controller
{
    // Liste des articles
    public function index()
    {
        $posts = Post::latest()->get(); // tous les articles, du plus récent au plus ancien

        return Inertia::render('frontend/Blog', [
            'posts' => $posts,
        ]);
    }

    // Article individuel
    // public function show($slug)
    // {
    //     $post = Post::where('slug', $slug)->firstOrFail();

    //     return Inertia::render('frontend/ShowBlog', [
    //         'post' => $post,
    //     ]);
    // }



    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->with([
                'comments.user' => function ($q) {
                    $q->select('id', 'name');
                }
            ])
            ->withCount('comments') // ⬅️ Ajouter le nombre total de commentaires
            ->firstOrFail();

        return Inertia::render('frontend/ShowBlog', [
            'post' => $post,
        ]);
    }


}
