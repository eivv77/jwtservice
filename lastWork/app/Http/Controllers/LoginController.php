<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public  function login(Request $request ){
        $creds = $request->only(['email', 'password']);

        $token = auth()->attempt($creds);

        return response()->json(['token' => $token]);

    }
}
