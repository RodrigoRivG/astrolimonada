<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;
use App\Services\PhotoService;

class PhotoController extends Controller
{

    private PhotoService $photoService;
    public function __construct(
        PhotoService $photoService
    ) {
        $this->photoService = $photoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     // No lo vamos ocupar.
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StorePhotoRequest $request)
    // {
    //     // No lo vamos ocupar.
    // }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $this->photoService->update($photo, $request->validated());

        return redirect()->back()->with('success', 'Foto/detalle actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $this->photoService->destroy($photo);

        return redirect()->back()->with('success', 'Foto eliminada correctamente');
    }
}
