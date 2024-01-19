<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:5', 'max:20'],
            'body' => ['required', 'min:5', 'max:2000'],
            'categories' => ['nullable', 'array'],
            'image' => ['file'],
        ];
    }
}
