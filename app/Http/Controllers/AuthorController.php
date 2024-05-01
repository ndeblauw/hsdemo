<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::whereNotNull('email_verified_at')->orderBy('name')->get();

        return view('public.authors.index', ['authors' => $authors]);
    }

    public function show(string $id)
    {
        $author = User::find($id);

        return view('public.authors.show', ['author' => $author]);
    }
}
