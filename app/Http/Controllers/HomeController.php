<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user_total = User::count();
        $file_total = File::count();

        return view('home', ['user_total' => $user_total, 'file_total' => $file_total]);
    }
}
