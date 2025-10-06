<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Use /api/login para autenticação']);
        }
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

        $token = $user->createToken('api_token')->plainTextToken;

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login realizado com sucesso',
                'user' => $user,
                'token' => $token,
            ]);
        }

        return redirect()->route('users.index');
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logout realizado']);
        }

        return redirect()->route('login');
    }
}
