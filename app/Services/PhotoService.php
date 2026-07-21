<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Photo;

class PhotoService
{
    // Aquí puedes agregar métodos relacionados con la lógica de negocio de las fotos, si es necesario.
    // public function store(Post $post, array $data): Photo
    // {
    //     // order y path ya se manejan en el PostService, aquí solo se crea la foto con los detalles proporcionados.
    //     $photo = $post->photos()->create([
    //         'details' => $data['details'] ?? null,
    //     ]);

    //     return $photo;
    // }

    public function update(Photo $photo, array $data): Photo
    {
        $photo->update($data); // Eloquent se encarga de actualizar solo los campos que se pasen en el array, por lo que si no se pasan 'details', no se modificará.

        return $photo;
    }

    public function destroy(Photo $photo): bool
    {
        // Eliminamos la imagen del almacenamiento público
        Storage::disk('public')->delete($photo->path);

        return $photo->delete();
    }
}
