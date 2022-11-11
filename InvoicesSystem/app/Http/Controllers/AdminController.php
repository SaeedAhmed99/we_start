<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request) {
        $users = User::latest()->paginate(5);

        return view('admin.index', compact('users'));
    }
}
