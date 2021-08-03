<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Seo;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $seo = Seo::first();

        return view('admin.seo.index', ['seo' => $seo]);
    }

    public function update(Request $request)
    {
        $seo = Seo::first();
        $data = $request->only(['keywords', 'autor', 'descricao', 'og_imagem', 'og_descricao']);

        $validator = Validator::make($data, [
            'keywords' => 'nullable|string',
            'descricao' => 'nullable|string|max:120',
            'autor' => 'nullable|string|max:50',
            'og_imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'og_descricao' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->route('seo')->withErrors($validator)->withInput();
        }

        if (isset($data['og_imagem'])) {
            $image = 'imagem.' . $data['og_imagem']->extension();
            $data['og_imagem']->storeAs('public/og', $image);
            $data['og_imagem'] = $image;
        } else {
            $data['og_imagem'] = null;
        }

        if ($seo) {
            $retorno = $this->store($data, $seo->id);
        } else {
            $retorno = $this->insert($data);
        }

        return redirect()->route('seo')->with(['success' => $retorno]);
    }

    private function insert($data)
    {
        $seo = new Seo();
        $seo->descricao = $data['descricao'];
        $seo->keywords = $data['keywords'];
        $seo->autor = $data['autor'];
        $seo->og_imagem = $data['og_imagem'];
        $seo->og_descricao = $data['og_descricao'];
        $seo->save();

        return 'Meta tags cadastradas com sucesso';
    }

    private function store($data, $id)
    {
        foreach ($data as $key => $value) {
            Seo::where(['id' => $id])->update([$key => $value]);
        }

        return 'Meta tags alteradas com sucesso';
    }
}
