<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Validation\ValidationException;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        auth()->login($this->create($request->all()));

        return redirect()->route('post.index');
    }


    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:16|min:3|alpha_dash|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => config('app.avatar')
        ]);
    }
}
