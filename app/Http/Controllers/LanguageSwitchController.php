<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageSwitchController extends Controller
{
    public function __invoke(Request $request, $locale)
    {
        $request->session()->put('locale', $locale);
        return redirect()->back();
    }
}
