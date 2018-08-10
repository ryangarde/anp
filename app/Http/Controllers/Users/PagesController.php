<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function contactUs()
    {
        return view('users.contact-us');
    }

    public function aboutUs()
    {
        return view('users.about-us');
    }

    public function instructions()
    {
        return view('users.instructions');
    }
}
