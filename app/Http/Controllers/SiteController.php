<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function produto()
    {
        return view('site.produto');
    }

    public function perfil()
    {
        return view('site.perfil');
    }

    public function relatorio()
    {
        return view('site.relatorio');
    }

    public function register()
    {
        return view('site.register');
    }

    public function login()
    {
        return view('site.login');
    }
}
