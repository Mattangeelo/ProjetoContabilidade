<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginSubmit(Request $request){
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:16'
            ],
            [
                'email.required' => 'O campo email deve ser preenchido.',
                'email.email' => 'O email inserido deve ser um email válido.',
                'password.required' => 'O campo senha deve ser preenchido.',
                'password.min' => 'O campo senha deve conter no mínimo 6 caracteres.',
                'password.max' => 'O campo senha deve conter no máximo 16 caracteres.'
            ]
        );

        $email = $request->input('email');
        $password = $request->input('password');

        if(!Storage::exists('usuarios.json')){
            return redirect()->back()->withInput()->with('loginError', 'Não existe nenhum usuario cadastrado!'); 
        }

        $usuarios = json_decode(Storage::get('usuarios.json'),true);

        foreach($usuarios as $usuario){
            if($usuario['email'] === $email && Hash::check($password,$usuario['senha']) && $usuario['admin'] === true){
                session([
                    'usuario' => [
                        'id' => $usuario['id'],
                        'email' => $usuario['email'],
                        'admin' => $usuario['admin'],
                    ]
                ]);
                return redirect()->to('/admin');
            }
        }

        return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos. Por favor, tente novamente!');
    }

    public function logout(){
        session()->forget('usuario');
        return response() ->redirectTo('/login')  
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }
}
