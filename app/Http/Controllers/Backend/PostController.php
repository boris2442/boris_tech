<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(12); // Pagination 12 par page
        return Inertia::render('backend/posts/PostIndex', [
            'posts' => $posts,
        ]);
    }
    public function create()
    {
        return Inertia::render('backend/posts/PostCreate');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($request->title);

        // Gestion de l'upload
        $imagePath = null;

        if ($request->hasFile('image')) {

            // Nom unique
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();

            // Déplacement vers public/blogs
            $request->image->move(public_path('blogs'), $imageName);

            // Lien sauvegardé dans la DB
            $imagePath = '/blogs/' . $imageName;
        }

        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,  // <-- lien complet
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')

            ->with(
                'flash',
                [
                    'message' => 'Article créé avec succès !',
                    'text' => 'ajoutez un autre',
                    'href' => route('posts.create')
                ]
            );

    }

    public function edit(Post $post)
    {
        return Inertia::render('backend/posts/PostEdit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($post->image && file_exists(storage_path('app/public/' . $post->image))) {
                unlink(storage_path('app/public/' . $post->image));
            }

            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('message', 'Post mis à jour avec succès.');
    }

    public function destroy(Post $post)
    {
        if ($post->image && file_exists(storage_path('app/public/' . $post->image))) {
            unlink(storage_path('app/public/' . $post->image));
        }

        $post->delete();

        return redirect()->route('posts.index')

            ->with(
                'flash',
                [
                    'message' => 'Article supprime avec succès !',
                    'text' => 'ajoutez un autre',
                    'href' => route('posts.create')
                ]
            );
    }

    public function AfficheFrontend()
    {
        $posts = Post::orderBy('created_at', 'desc')->get(); // Pagination 6 par page
        return Inertia::render('frontend/Blog', [
            'posts' => $posts,
        ]);
    }



}
