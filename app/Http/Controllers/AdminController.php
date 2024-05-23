<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class AdminController extends Controller
{
    public function obtenerAdmin(){
        $admin = User::where('role', 'admin')->first();
        return response()->json($admin);
    }
}
