<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke (Request $request) {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|min:6'
        ]);

        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return abort(401);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }
}
