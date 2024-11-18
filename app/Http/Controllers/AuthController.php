<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    // User Registration
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'no_ktp' => 'required|unique:users|max:255', // Validate no_ktp (primary key)
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed', // Ensure password is confirmed
            // 'role_id' => 'required|exists:roles,id', // Assuming you have a roles table
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create the user
        $user = User::create([
            'no_ktp' => $request->no_ktp,
            'name' => $request->name,
            'password' => $request->password,
            'role_id' => 2,
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201)->header('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    }

    // User Login
    public function login(Request $request)
    {
        $credentials = $request->only('no_ktp', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Reni')->plainTextToken;

            return response()->json([
                'message' => 'Login successful!',
                'token' => $token,
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Logout
    public function logout(Request $request)
    {
        // Revoke the user's current token
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            'message' => 'Logged out successfully!'
        ]);
    }

    // Get authenticated user info
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
