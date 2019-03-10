<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function __invoke(Request $request) {
        return new UserResource($request->user());
    }
}
