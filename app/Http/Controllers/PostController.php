<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        // Listar posts de un usuario específico, se retorna la plantilla blade de resources/views/posts/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Se retorna la plantilla blade de resources/views/posts/create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $user = $request->user();
        $post = $this->postService->store($user, $request->validated());

        return redirect()->back()->with('success', 'Post creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar un post específico, se retorna la plantilla blade de resources/views/posts/show.blade.php
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
