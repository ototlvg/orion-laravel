<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('checkCookie')->except('login');
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);


        if($token == null){
            return response()->json('Usuario o contraseña incorrectos', 404);
        }
        return response()->json($token, 201);
    }

    public function checkAuth()
    {
        $user = auth()->userOrFail();
        return response()->json(true, 201);
    }
}
