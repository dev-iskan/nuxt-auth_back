<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }


    public function __invoke()
    {
        auth()->logout();
    }
}
