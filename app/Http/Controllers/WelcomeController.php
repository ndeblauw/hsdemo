<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        return view('welcome', ['articles' => $articles]);
    }
}
