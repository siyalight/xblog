<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        return view('user.show', compact('user'));
    }
}
