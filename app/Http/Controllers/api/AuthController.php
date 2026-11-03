<?php

namespace App\Http\Controllers\api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\Request;

// p.s : Error handling is on bootstrap/app.php
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:5|confirmed',
        ]);
        
        try {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = Auth::user()->createToken('token-' . $request->email)->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Login Successfuly',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }   

    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout Successfuly'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:5|confirmed',
        ]);

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => Role::EMPLOYEE,
            ]);
    
            return response()->json([
                'access_token' => $user->createToken('auth_token')->plainTextToken,
                'token_type' => 'Bearer',
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}
