<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|string',
            'password' => 'required|string|max:255|min:8'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials, please check your email and password or create new account',
                'errors' => [
                    'email' => 'Invalid credentials',
                    'password' => 'Incorrect password'
                ]
            ], 403);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->status != 'active') {
            return response()->json([
                'message' => 'Account need to activate.'
            ]);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'message' => 'Request successfully.',
            'current_user' => $user,
            'access_token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255|min:6',
            'last_name' => 'required|string|max:255|min:6',
            'email' => 'required|email|max:255|string',
            'password' => 'required|min:8|string|confirmed',
            'mobile_number' => 'required|min:11|max:11|string',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'status' => 'active'
        ]);

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'message' => 'Create successfully.',
            'current_user' => $user,
            'access_token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}
