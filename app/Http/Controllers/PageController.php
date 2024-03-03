<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function index(): View
    {
        return view('site.index');
    }

    public function about(): View
    {
        return view('site.about');
    }

    public function lang_change(Request $request, $lang)
    {
        $lang = $this->localeResolver($lang);
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }

    private function localeResolver($lang): string
    {
        $lang = trim(strtolower($lang));
        return match ($lang) {
            'ru' => 'ru',
            'en' => 'en',
            default => 'uz',
        };
    }
    //i need goo method for register user, ehwn noe existn in users table
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::create($request->all());
        return response()->json($user, 201);
    }
}
