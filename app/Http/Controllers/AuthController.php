<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
            'text_username' => 'required|email',
            'text_password' => 'required|min:6|max:16'
        ],
        [
            'text_username.required' => 'O username é obrigatório',
            'text_username.email' => 'O username deve ser um email válido',
            'text_password.required' => 'A senha é obrigatória',
            'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
            'text_password.max' => 'A senha deve ter menos :max caracteres'
        ]
    ); 

        $username = $request->input('text_username');
        $password = $request->input('text_password');

    
        $user = User::where('username', $username)->where('deleted_at', null)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with(['loginError' => 'user or password not found!']);
        }

        
        if(!password_verify($password, $user->password)){
            return redirect()->back()->withInput()->with(['loginError' => 'user or password not found!']);
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        
        session([
            'user' => $user->id,
            'username' => $user->username
        ]);

        echo 'LOGIN SUCCESS';
    }
}
