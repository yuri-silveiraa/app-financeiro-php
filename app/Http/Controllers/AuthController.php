<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
            return back()->withErrors(['email' => 'Credenciais inválidas']);
        }

        $token = JWTAuth::fromUser($user);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login realizado com sucesso',
                'user' => $user,
                'token' => $token,
            ]);
        }

        return redirect()->route('expensive.expensive', ['id' => $user->id])->withCookie(cookie('token', $token, 60));
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logout realizado']);
        }

        return redirect()->route('login');
    }

    public function me(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json($user);
    }
}
