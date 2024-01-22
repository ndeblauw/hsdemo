<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(3);

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        $user = $user->load('posts');

        return new UserResource($user);
    }

    //
}
