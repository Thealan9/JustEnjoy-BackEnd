<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        return response()->json(
            User::select('id', 'name', 'email', 'role', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    public function update(Request $request, User $user){
        if ($request->user()->id === $user->id) {
        return response()->json([
            'message' => 'No puedes modificar tu propio usuario'
        ], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'active' => 'boolean',
        ]);

        $user->update($data);
        return response()->json([
        'message' => 'Usuario actualizado',
        'user' => $user
        ]);
    }

    public function show($id){
        $user = User::findOrFail($id);

        return response()->json($user);
    }
}
