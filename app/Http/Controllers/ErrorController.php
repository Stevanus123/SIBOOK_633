<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorController extends Controller
{
        public function not_found()
    {
        $user = Auth::user();
        return response()->view('errors.404', ['active' => '', 'user' => $user], 404);
    }
}