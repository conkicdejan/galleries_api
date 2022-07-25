<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['token' => $token, 'user' => Auth::user()]);
    }

    public function register(RegisterRequest $request)
    {

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = Auth::login($user);

        return response()->json(['token' => $token, 'user' => Auth::user()]);
    }

    public function getMyProfile()
    {
        return response()->json(Auth::user());
    }

    public function refresh()
    {
        $token = Auth::refresh();

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}