<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginRegisterController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
    }
    //
}
