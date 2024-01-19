<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => route('posts.show', $this),
            'published_at' => $this->published_at?->format('Y-m-d H:i') ?? 'Not published yet',
            'author' => new UserResource($this->author),
            'sponsored' => $this->sponsored ? 'Yes' : 'No',
            'body' => $this->body,
        ];
    }
}
