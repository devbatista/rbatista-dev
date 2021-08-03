<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::first();

        return view('admin.settings.index', ['user' => $user]);
    }

    public function save(Request $request)
    {
        $id = Auth::id();
        $data = $request->only(['password', 'password_confirmation']);

        $validator = Validator::make($data, [
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('settings', ['user' => $data['id']])->withErrors($validator)->withInput();
        }

        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        User::where(['id' => $id])->update(['password' => $password]);

        return redirect()->route('settings')->with(['success' => 'Senha alterada com sucesso']);
    }
}
