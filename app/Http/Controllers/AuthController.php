<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use function Laravel\Prompts\text;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        echo 'logout';
    }

    public function login_submit(Request $request)
    {
       $request->validate([
            'text_username' => 'required',
            'text_password' => 'required'
        ]); 

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        echo 'OK!';
    }
}
