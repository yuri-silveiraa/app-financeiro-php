<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        if ($request->wantsJson()) {
            return response()->json($users);
        }

        return view('index', compact('users'));
    }

    public function create(Request $request)
    {
        $fields = ['name', 'email', 'password'];

        if ($request->wantsJson()) {
            return response()->json(['fields' => $fields]);
        }

        return view('auth.register', compact('fields'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Usuário criado com sucesso',
                'user' => $user
            ], 201);
        }

        return redirect()->route('expensive.expensive')->with('success', 'Usuário criado com sucesso!');
    }

    public function show(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($user);
        }

        return view('user.user', compact('user'));
    }

    public function edit(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $fields = ['name', 'email', 'password'];

        if ($request->wantsJson()) {
            return response()->json([
                'user' => $user,
                'fields' => $fields
            ]);
        }

        return view('user.edit', compact('user', 'fields'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$id}",
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user = User::findOrFail($id);
        $user->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Usuário atualizado com sucesso',
                'user' => $user
            ]);
        }

        return redirect()->route('user.user')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Usuário removido com sucesso']);
        }

        return redirect()->route('login')->with('success', 'Usuário removido com sucesso!');
    }
}

