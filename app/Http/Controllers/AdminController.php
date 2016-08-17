<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    //
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth','admin'], ['except' => 'show']);
    }
    public function index()
    {
        return view('admin.index');
    }
}
