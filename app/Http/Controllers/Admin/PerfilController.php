<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $perfil = Perfil::first();

        return view('admin.profile.index', ['perfil' => $perfil]);
    }

    public function save(Request $request)
    {
        $data = $request->only(['nome','profissao','dt_nascimento','email','telefone','endereco','cpf','cnpj']);
        $id = Auth::id();
        unset($data['id']);
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('profile')->withErrors($validator)->withInput();
        }
        
        foreach($data as $item => $value){
            Perfil::where(['id' => $id])->update([$item => $value]);
        }

        return redirect()->route('profile')->with(['success' => 'Informações alteradas com sucesso']);
    }

    private function validator($data)
    {
        return Validator::make($data, [
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'profissao' => 'required',
            'dt_nascimento' => 'required|date',
            'telefone' => 'required',
            'endereco' => 'required',
            'cpf' => 'nullable|cpf',
            'cnpj' => 'nullable|cnpj',
        ]);
    }
}