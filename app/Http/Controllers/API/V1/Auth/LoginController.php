<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Models\User;
use App\Http\Controllers\APIController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class LoginController extends APIController
{
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->responseUnauthorized();
        }

        $user = auth()->user();
        $token = Str::random(60);
        $user = User::find(1);
        $user->remember_token = hash('sha256', $token);
        $api_token = hash('sha256', $token);
        $user->save();

            return response()->json([
            'status' => 200,
            'message' => 'Authorized.',
            'access_token' => $api_token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => array(
                'id' => $user->id,
                'name' => $user->name,
                'email'=> $user->email
            )
        ], 200);

    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 200,
            'message' => 'Successfully logged out.'
        ], 200);

    }
}
