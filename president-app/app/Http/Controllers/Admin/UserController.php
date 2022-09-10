<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', session()->get('user')->id)->where('isDeleted', false)->with('media')->with('role')->with('user')->paginate(20);
        return view('interfaces.admin.users', compact('users'));
    }
}
