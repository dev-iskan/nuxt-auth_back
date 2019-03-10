<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __invoke (Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'email' => ['These credentials do not match our records.']
                ]
            ], 422);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }
}
