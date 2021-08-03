<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
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
        $portfolio = Portfolio::orderBy('id', 'desc')->get();

        return view('admin.portfolio.index', ['portfolio' => $portfolio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['titulo', 'link', 'descricao', 'thumb']);

        $validator = Validator::make($data, [
            'titulo' => 'required|string',
            'link' => 'required|string',
            'descricao' => 'required|string',
            'thumb' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('portfolio.create')->withErrors($validator)->withInput();
        }

        $hasLink = Portfolio::where(['link' => $data['link']])->first();
        if ($hasLink) {
            $validator->errors()->add('link', __('validation.unique', [
                'attribute' => 'link',
            ]));

            return redirect()->route('portfolio.create')->withErrors($validator)->withInput();
        }

        $portfolio = new Portfolio();
        $portfolio->titulo = $data['titulo'];
        $portfolio->descricao = $data['descricao'];
        $portfolio->link = $data['link'];
        $portfolio->save();
        
        $image = 'portfolio-'. $portfolio->id .'.' . $data['thumb']->extension();
        $data['thumb']->storeAs('public/portfolio', $image);

        Portfolio::where(['id' => $portfolio->id])->update(['thumb' => $image]);

        return redirect()->route('portfolio.index')->with(['success' => 'Item criado com sucesso']);
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
        $portfolio = Portfolio::find($id);

        return view('admin.portfolio.edit', ['portfolio' => $portfolio]);
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
        $portfolio = Portfolio::find($id);
        if (!$portfolio) {
            return false;
        }

        $data = $request->only(['titulo', 'link', 'descricao', 'thumb']);

        $validator = Validator::make($data, [
            'titulo' => 'required|string',
            'link' => 'required|string',
            'descricao' => 'required|string',
            'thumb' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('portfolio.edit', ['portfolio' => $id])->withErrors($validator)->withInput();
        }

        if ($data['link'] != $portfolio['link']) {
            $hasLink = Portfolio::where('portfolio', $data['portfolio'])->first();

            if ($hasLink) {
                $validator->errors()->add('link', __('validation.unique', [
                    'attribute' => 'link',
                ]));

                return redirect()->route('portfolio.edit', ['portfolio' => $id])->withErrors($validator)->withInput();
            }
        }

        foreach ($data as $key => $value) {
            Portfolio::where(['id' => $id])->update([$key => $value]);
        }

        return redirect()->route('portfolio.index')->with(['success' => 'Item alterado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with(['success' => 'Item deletado com sucesso']);
    }
}
