<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class SobreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sobre = Perfil::select('sobre')->where(['id' => Auth::id()])->first();

        return view('admin.about.index', $sobre);
    }

    public function save(Request $request)
    {
        $data = $request->only('sobre');

        if($data['sobre'] == null) {
            return redirect()->route('sobre')->withErrors(['Sobre' => 'Campo não pode ser enviado vazio'])->withInput();
        }
        
        Perfil::where(['id' => Auth::id()])->update($data);

        return redirect()->route('sobre')->with(['success' => 'Informações alteradas com sucesso']);
    }
}
