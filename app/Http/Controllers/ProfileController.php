<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() : JsonResponse {
        return response()->json(auth()->user());
    }

    public function update(Request $request) : JsonResponse {


        return response()->json(auth()->user());
    }
}
