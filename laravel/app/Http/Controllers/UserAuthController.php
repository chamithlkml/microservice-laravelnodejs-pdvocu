<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{

    public function register(Request $request)
    {
        $userData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);

        $userResponse = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'auth_token' => $user->createToken('access-token-' . $this->id)->plainTextToken
        ];

        return response()->json($userResponse, 200);
    
    }
}
