<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class UserController extends Controller
{
    public function obtenerUser(){
        $user = User::where('rol', 'user')->first();
        return response()->json($user);
    }
    
    public function obtenerAdmin(){
        $admin = User::where('rol', 'admin')->first();
        return response()->json($admin);
    }

}