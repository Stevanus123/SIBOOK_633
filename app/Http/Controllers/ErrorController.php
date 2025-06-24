<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
        public function not_found()
    {
        return response()->view('errors.404', ['active' => ''], 404);
    }
}