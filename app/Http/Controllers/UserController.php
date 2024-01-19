<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select(['id', 'name'])->withCount('posts')->get();

        return view('site.users.index', [
            'users' => $users,
        ]);
    }

    public function show(User $user)
    {
        return view('site.users.show', [
            'user' => $user,
        ]);
    }
}
