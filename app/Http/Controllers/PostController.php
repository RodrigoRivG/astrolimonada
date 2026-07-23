<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use App\Models\Post;


class PostController extends Controller
{

    private PostService $postService;
    public function __construct(
        PostService $postService
    ) {
        $this->postService = $postService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->query('search', '');
        $posts = Post::with(['user', 'photos', 'tags'])
            ->when($searchTerm, fn($query) => $query->search($searchTerm))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
            'searchTerm' => $searchTerm,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $user = $request->user();
        $this->postService->store($user, $request->validated());

        return redirect()->back()->with('success', 'Post creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mostrar el formulario de edición de un post específico, se retorna la plantilla blade de resources/views/posts/edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = $this->postService->update($post, $request->validated());

        return redirect()->back()->with('success','Actualizado de manera correcta');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postService->destroy($post);

        return redirect()->back()->with('success','Eliminado de manera correcta');
    }
}
