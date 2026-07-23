<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

class PostService
{
    public function store(User $user, array $data): Post
    {
        $post = $user->posts()->create([
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        if (!empty($data['photos'])) {
            $this->attachPhotos($post, $data['photos']);
        }

        if (!empty($data['tags'])) {
            $this->syncTags($post, $data['tags']);
        }

        return $post;
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data); 

        return $post;
    }

    public function destroy(Post $post): bool
    {
        return $post->delete();
    }

    private function attachPhotos(Post $post, array $photos): void
    {
        foreach ($photos as $index => $photoFile) {
            $path = $photoFile->store('photos', 'public');

            $post->photos()->create([
                'order' => $index,
                'path' => $path,
            ]);
        }
    }

    private function syncTags(Post $post, array $tagNames): void
    {
        $tagIds = collect($tagNames)->map(function (string $name) {
            return Tag::firstOrCreate(['name' => $name])->id;
        });

        $post->tags()->sync($tagIds);
    }
}
