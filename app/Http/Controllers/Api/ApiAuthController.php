<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:8']
        ]);

        if ($credentials->fails()) {
            return response()->json([
                'message' => $credentials->errors()
            ], 401);
        }

        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        if (!$user->tokenCan('fouaille_token')) {
            $user->tokens()->delete();
            $token = $user->createToken('fouaille_token')->plainTextToken;
        } else {
            $token = $user->tokens()->where('name', 'fouaille_token')->first()->plainTextToken;
        }

        return response()->json([
            'message' => 'You are logged in',
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function register(Request $request){
        $credentials = Validator::make($request->all(), [
            'name' => ['string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if ($credentials->fails()) {
            return response()->json([
                'message' => $credentials->errors()
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('fouaille_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function isTokenWorking()
    {


        return response()->json([
            'message' => 'Token is working'
        ]);
    }
}
