<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RedesSociais;

class RedesSociaisController extends Controller
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
        $redesSociais = RedesSociais::get();

        return view('admin.social-media.index', ['redesSociais' => $redesSociais]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.social-media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['nome', 'link']);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:25',
            'link' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->route('social-media.create')->withErrors($validator)->withInput();
        }

        $socialMedia = new RedesSociais();
        $socialMedia->nome = strtolower($data['nome']);
        $socialMedia->link = strtolower($data['link']);
        $socialMedia->save();

        return redirect()->route('social-media.index')->with(['success' => 'Rede Social criada com sucesso']);
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
        $redeSocial = RedesSociais::find($id);

        return view('admin.social-media.edit', ['redeSocial' => $redeSocial]);
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
        $redeSocial = RedesSociais::find($id);
        if (!$redeSocial) {
            return false;
        }

        $data = $request->only(['nome', 'link']);
        $data['nome'] = strtolower($data['nome']);
        $data['link'] = strtolower($data['link']);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:25',
            'link' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->route('social-media.edit', ['social_medium' => $id])->withErrors($validator)->withInput();
        }

        foreach ($data as $key => $value) {
            RedesSociais::where(['id' => $id])->update([$key => $value]);
        }

        return redirect()->route('social-media.index')->with(['success' => 'Rede Social alterada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $redeSocial = RedesSociais::find($id);
        $redeSocial->delete();

        return redirect()->route('social-media.index')->with(['success' => 'Rede Social deletada com sucesso']);
    }
}
