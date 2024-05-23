<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class UserController extends Controller
{
    public function obtenerUser(){
        $user = User::where('role', 'user')->first();
        return response()->json($user);
    }
}