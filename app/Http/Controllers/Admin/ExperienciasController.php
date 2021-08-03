<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienciasController extends Controller
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
        $experiencias = Experiencia::orderBy('id', 'desc')->get();

        return view('admin.experiences.index', ['experiencias' => $experiencias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['cargo', 'empresa', 'inicio', 'fim', 'atualmente', 'descricao']);
        // dd($data);

        $validator = Validator::make($data, [
            'cargo' => 'required|string',
            'empresa' => 'required|string',
            'inicio' => 'required|date|before:today',
            'fim' => 'nullable|date|before:today',
            'atualmente' => 'nullable',
            'descricao' => 'required|string|max:255',
        ]);

        if((isset($data['fim'])) && ($data['fim'] < $data['inicio'])) {
            $validator->errors()->add('fim', 'Data do fim não pode ser menor do que a data de início', [
                'attribute' => 'fim',
            ]);

            return redirect()->route('experiences.create')->withErrors($validator)->withInput();
        }

        if ((!isset($data['fim']) || $data['fim'] == null) && !isset($data['atualmente'])) {
            $validator->errors()->add('fim', 'Os dois campos, fim e atualmente, não podem ser nulos, somente um ou outro', [
                'attribute' => 'fim',
            ]);

            return redirect()->route('experiences.create')->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return redirect()->route('experiences.create')->withErrors($validator)->withInput();
        }

        $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        $mesInicio = date('m', strtotime($data['inicio']));
        $anoInicio = date('Y', strtotime($data['inicio']));
        $inicio = $meses[$mesInicio - 1] . '/' . $anoInicio;

        if (isset($data['fim'])) {
            $mesFim = date('m', strtotime($data['fim']));
            $anoFim = date('Y', strtotime($data['fim']));
            $fim = $meses[$mesFim - 1] . '/' . $anoFim;
        }

        $experiencia = new Experiencia();
        $experiencia->cargo = $data['cargo'];
        $experiencia->empresa = $data['empresa'];
        $experiencia->inicio = $inicio;
        $experiencia->fim = (isset($data['atualmente'])) ? 'Atualmente' : $fim;
        $experiencia->descricao = $data['descricao'];
        $experiencia->save();

        return redirect()->route('experiences.index')->with(['success' => 'Experiência criada com sucesso']);
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
        $experiencia = Experiencia::find($id);
        $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        if ($experiencia['fim'] != 'Atualmente') {
            $experiencia['fim'] = explode('/', $experiencia['fim']);
            $mes = array_search($experiencia['fim'][0], $meses) + 1;
            $mes = ($mes < 10) ? '0' . $mes : $mes;
            $experiencia['fim'] = $experiencia['fim'][1] . '-' . $mes;
            $experiencia['atualmente'] = false;
        } else {
            $experiencia['fim'] = false;
            $experiencia['atualmente'] = true;
        }

        $experiencia['inicio'] = explode('/', $experiencia['inicio']);
        $mes = array_search($experiencia['inicio'][0], $meses) + 1;
        $mes = ($mes < 10) ? '0' . $mes : $mes;
        $experiencia['inicio'] = $experiencia['inicio'][1] . '-' . $mes;

        return view('admin.experiences.edit', ['experiencia' => $experiencia]);
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
        $experiencia = Experiencia::find($id);
        if (!$experiencia) {
            return false;
        }

        $data = $request->only(['cargo', 'empresa', 'inicio', 'fim', 'atualmente', 'descricao']);

        $validator = Validator::make($data, [
            'cargo' => 'required|string',
            'empresa' => 'required|string',
            'inicio' => 'required|date|before:today',
            'fim' => 'nullable|date|before:today',
            'atualmente' => 'nullable',
            'descricao' => 'required|string|max:255',
        ]);

        if((isset($data['fim'])) && ($data['fim'] < $data['inicio'])) {
            $validator->errors()->add('fim', 'Data do fim não pode ser menor do que a data de início', [
                'attribute' => 'fim',
            ]);

            return redirect()->route('experiences.edit', ['experience' => $id])->withErrors($validator)->withInput();
        }

        if ((!isset($data['fim']) || $data['fim'] == null) && !isset($data['atualmente'])) {
            $validator->errors()->add('fim', 'Os dois campos, fim e atualmente, não podem ser nulos, somente um ou outro', [
                'attribute' => 'fim',
            ]);

            return redirect()->route('experiences.edit', ['experience' => $id])->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
            return redirect()->route('experiences.edit', ['experience' => $id])->withErrors($validator)->withInput();
        }

        $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        $mesInicio = date('m', strtotime($data['inicio']));
        $anoInicio = date('Y', strtotime($data['inicio']));
        $data['inicio'] = $meses[$mesInicio - 1] . '/' . $anoInicio;

        if (isset($data['fim'])) {
            $mesFim = date('m', strtotime($data['fim']));
            $anoFim = date('Y', strtotime($data['fim']));
            $data['fim'] = $meses[$mesFim - 1] . '/' . $anoFim;
        }

        unset($data['atualmente']);

        foreach($data as $key => $value) {
            Experiencia::where(['id' => $id])->update([$key => $value]);
        }

        return redirect()->route('experiences.index')->with(['success' => 'Experiência alterada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $experiencia = Experiencia::find($id);
        $experiencia->delete();

        return redirect()->route('experiences.index')->with(['success' => 'Experiência deletada com sucesso']);
    }
}
