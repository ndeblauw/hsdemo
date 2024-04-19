<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::whereNotNull('email_verified_at')->orderBy('name')->get();

        return view('authors.index', ['authors' => $authors]);
    }

    public function show(string $id)
    {
        $author = User::find($id);

        return view('authors.show', ['author' => $author]);
    }
}
