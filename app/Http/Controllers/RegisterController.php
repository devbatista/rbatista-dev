<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegisterMessage;

class RegisterController extends Controller
{
    public function index()
    {
        $perfil = Perfil::first();

        // if ($perfil != null) {
        //     return redirect()->route('login');
        // }

        return view('vendor.adminlte.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->only([
            'nome',
            'email',
            'password',
            'password_confirmation',
            'profissao',
            'dt_nascimento',
            'telefone',
            'endereco',
            'cpf',
            'cnpj',
        ]);

        $validator = $this->validator($data);
        
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $user = [
            'nome' => $data['nome'],
            'email' => $data['email'],
            'password' => $data['password'],
            'token_confirmation' => md5(time() . rand(0, 999)),
        ];

        array_splice($data, 2, 2);

        $verifyUser = User::first();
        if ($verifyUser) {
            return redirect()->route('login');
        }
        $newUser = $this->create($user, 'user');
        // Auth::login($newUser);

        $verifyPerfil = Perfil::first();
        if ($verifyPerfil) {
            return redirect()->route('admin');
        }
        $newPerfil = $this->create($data, 'perfil');
        
        Mail::send(new SendRegisterMessage());

        return redirect()->route('admin');
    }

    private function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|confirmed|min:8',
            'profissao' => 'required',
            'dt_nascimento' => 'required|date',
            'telefone' => 'required',
            'endereco' => 'required',
            'cpf' => 'nullable|cpf',
            'cnpj' => 'nullable|cnpj',
        ]);
    }

    private function create(array $data, $table)
    {
        switch ($table) {
            case 'user':
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                $user = new User();
                $user->nome = $data['nome'];
                $user->email = $data['email'];
                $user->password = $data['password'];
                $user->token_confirmation = md5(time());
                $user->email_confirmation = 0;
                $user->save();

                return $user;
                break;

            case 'perfil':
                $perfil = new Perfil();
                $perfil->nome = $data['nome'];
                $perfil->email = $data['email'];
                $perfil->profissao = $data['profissao'];
                $perfil->dt_nascimento = $data['dt_nascimento'];
                $perfil->telefone = $data['telefone'];
                $perfil->endereco = $data['endereco'];
                $perfil->cpf = $data['cpf'];
                $perfil->cnpj = $data['cnpj'];
                $perfil->save();

                return $perfil;
                break;
            default:
                exit;
        }
    }
}
