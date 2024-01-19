<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostMiniResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'url' => route('posts.show', $this),
            'published_at' => $this->published_at->format('Y-m-d H:i'),
        ];
    }
}
