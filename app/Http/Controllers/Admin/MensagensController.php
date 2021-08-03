<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mensagem;
use Carbon\Carbon;

class MensagensController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mensagens = Mensagem::all();

        foreach ($mensagens as $mensagem) {
            $mensagem->mensagem = $this->limitaCaracteres($mensagem->mensagem, 15);
        }

        return view('admin.messages.index', ['mensagens' => $mensagens]);
    }

    public function show($id)
    {
        $mensagem = Mensagem::find($id);
        $mensagem->data_hora = date('d-m-Y H:i', strtotime($mensagem->created_at));

        return view('admin.messages.show', ['mensagem' => $mensagem]);
    }

    public function delete($id)
    {
        $mensagem = Mensagem::find($id);
        $mensagem->delete();

        return redirect()->route('messages')->with(['success' => 'Mensagem deletada com sucesso']);
    }

    private function limitaCaracteres($texto, $limite, $quebra = true)
    {
        $tamanho = strlen($texto);
        if ($tamanho <= $limite) {
            $novo_texto = $texto;
        } else if ($quebra == true) {
            $novo_texto = trim(substr($texto, 0, $limite)) . "...";
        } else {
            $ultimo_espaco = strrpos(substr($texto, 0, $limite), " ");
            $novo_texto = trim(substr($texto, 0, $ultimo_espaco)) . "...";
        }

        return $novo_texto;
    }
}
