<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcademicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academico = Academico::orderBy('id', 'desc')->get();

        return view('admin.academic.index', ['academico' => $academico]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.academic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('titulo', 'instituicao', 'inicio', 'fim', 'finalizado', 'tipo', 'descricao');

        $validator = Validator::make($data, [
            'titulo' => 'required|string',
            'instituicao' => 'required|string',
            'inicio' => 'required|integer',
            'fim' => 'nullable|integer',
            'tipo' => 'required|string',
            'descricao' => 'required|string|max:255',
        ]);

        if ($data['inicio'] > date('Y')) {
            $validator->errors()->add('inicio', 'Coloque apenas as atividades acadêmicas que já inicou ou irá iniciar esse ano', [
                'attribute' => 'inicio',
            ]);

            return redirect()->route('academic.create')->withErrors($validator)->withInput();
        }

        if ($data['inicio'] > $data['fim']) {
            $validator->errors()->add('inicio', 'O ano de início não pode ser maior do que o ano de fim', [
                'attribute' => 'inicio',
            ]);

            return redirect()->route('academic.create')->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return redirect()->route('academic.create')->withErrors($validator)->withInput();
        }

        $data['fim'] = ($data['fim'] > date('Y')) ? 'Atualmente' : $data['fim'];

        switch ($data['finalizado']) {
            case 'atualmente':
                $data['fim'] = 'Atualmente';
                break;

            case 'incompleto':
                $data['fim'] = 'Incompleto';
                break;

            default:
                unset($data['atualmente']);
                break;
        }

        $academico = new Academico();
        $academico->titulo = $data['titulo'];
        $academico->instituicao = $data['instituicao'];
        $academico->inicio = $data['inicio'];
        $academico->fim = $data['fim'];
        $academico->tipo = $data['tipo'];
        $academico->descricao = $data['descricao'];
        $academico->save();

        return redirect()->route('academic.index')->with(['success' => 'Item criado com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $academico = Academico::find($id);
        if ($academico['fim'] == 'Atualmente' || $academico['fim'] == 'Incompleto') {
            $academico['finalizado'] = strtolower($academico['fim']);
            $academico['fim'] = false;
        } else {
            $academico['finalizado'] = 'finalizado';
        }

        return view('admin.academic.edit', ['academico' => $academico]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $academico = Academico::find($id);
        if (!$academico) {
            return false;
        }

        $data = $request->only(['titulo', 'instituicao', 'inicio', 'fim', 'finalizado', 'tipo', 'descricao']);
        $data['fim'] = (isset($data['fim'])) ? $data['fim'] : null;

        $validator = Validator::make($data, [
            'titulo' => 'required|string',
            'instituicao' => 'required|string',
            'inicio' => 'required|integer',
            'fim' => 'nullable|integer',
            'tipo' => 'required|string',
            'descricao' => 'required|string|max:255',
        ]);

        if($data['finalizado'] == 'finalizado' && !$data['fim']) {
            $validator->errors()->add('fim', 'Se o curso foi finalizado, é necessário colocar o ano de encerramento', [
                'attribute' => 'fim',
            ]);

            return redirect()->route('academic.edit', ['academic' => $id])->withErrors($validator)->withInput();
        }

        if ($data['inicio'] > date('Y')) {
            $validator->errors()->add('inicio', 'Coloque apenas as atividades acadêmicas que já inicou ou irá iniciar esse ano', [
                'attribute' => 'inicio',
            ]);

            return redirect()->route('academic.edit', ['academic' => $id])->withErrors($validator)->withInput();
        }

        if (($data['fim']) && ($data['inicio'] > $data['fim'])) {
            $validator->errors()->add('inicio', 'O ano de início não pode ser maior do que o ano de fim', [
                'attribute' => 'inicio',
            ]);

            return redirect()->route('academic.edit', ['academic' => $id])->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return redirect()->route('academic.edit', ['academic' => $id])->withErrors($validator)->withInput();
        }

        $data['fim'] = ($data['finalizado'] != 'finalizado') ? ucfirst($data['finalizado']) : $data['fim'];
        $data['fim'] = ($data['fim'] > date('Y')) ? 'Atualmente' : $data['fim'];
        unset($data['finalizado']);

        foreach($data as $key => $value) {
            Academico::where(['id' => $id])->update([$key => $value]);
        }

        return redirect()->route('academic.index')->with(['success' => 'Item alterado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $academico = Academico::find($id);
        $academico->delete();

        return redirect()->route('academic.index')->with(['success' => 'Item deletado com sucesso']);
    }
}
