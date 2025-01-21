<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('home', ['user' => $user]); // Send user data to the view
    }
}
