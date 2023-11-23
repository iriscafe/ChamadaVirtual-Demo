<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Method to handle user login
    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required',
            'password' => 'required',
        ]);

        /** @var User $user */
        $user = User::query()->where('cpf', $request->input('cpf'))->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'cpf' => ['The provided credentials are incorrect.'],
            ]);
        }
        if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'token' => $user->createToken($request->device_name ?? 'unknown')->plainTextToken,
                'user' => $request->user()
            ]);
        }

        throw ValidationException::withMessages([
            'cpf' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Method to handle user logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
