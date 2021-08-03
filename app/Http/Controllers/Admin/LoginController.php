<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('vendor.adminlte.auth.login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->only(['email', 'password']);        

        $validator = $this->validator($data);
        $remember = $request->input('remember', false);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $token = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $remember);

        if (!$token) {
            $validator->errors()->add('password', 'Email e/ou senha incorretos!');

            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        return redirect()->route('admin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    private function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:8'
        ]);
    }
}
