<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('posts.comments')->get();
        return view('users.index', compact('users'));
    }
    
    public function posts($id)
    {
        $user = User::with('posts')->find($id);
        return view('users.post', compact('user'));
    }
}