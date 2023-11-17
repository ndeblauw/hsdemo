<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('site.users.index', [
            'users' => $users,
        ]);
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('site.users.show', [
            'user' => $user,
        ]);
    }
}
