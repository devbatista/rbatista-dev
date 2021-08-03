<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SkillsController extends Controller
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
        $skills = Skill::all();

        return view('admin.skills.index', ['skills' => $skills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['skill', 'porcentagem']);

        $validator = Validator::make($data, [
            'skill' => 'required|string',
            'porcentagem' => 'required|int',
        ]);

        if ($validator->fails()) {
            return redirect()->route('skills.create')->withErrors($validator)->withInput();
        }

        $hasSkill = Skill::where(['skill' => $data['skill']])->first();

        if ($hasSkill) {
            $validator->errors()->add('skill', __('validation.unique', [
                'attribute' => 'skill',
            ]));

            return redirect()->route('skills.create')->withErrors($validator)->withInput();
        }

        $skill = new Skill();
        $skill->skill = $data['skill'];
        $skill->porcentagem = $data['porcentagem'];
        $skill->save();

        return redirect()->route('skills.index')->with(['success' => 'Skill criado com sucesso']);
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
        $skill = Skill::where(['id' => $id])->first();

        return view('admin.skills.edit', ['skill' => $skill]);
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
        $skill = Skill::find($id);
        if (!$skill) {
            return false;
        }

        $data = $request->only(['skill', 'porcentagem']);

        $validator = Validator::make($data, [
            'skill' => 'required|string',
            'porcentagem' => 'required|int'
        ]);

        if ($validator->fails()) {
            return redirect()->route('skills.edit', ['skill' => $id])->withErrors($validator)->withInput();
        }

        if ($data['skill'] != $skill['skill']) {
            $hasSkill = Skill::where('skill', $data['skill'])->first();

            if ($hasSkill) {
                $validator->errors()->add('skill', __('validation.unique', [
                    'attribute' => 'skill',
                ]));

                return redirect()->route('skills.edit', ['skill' => $id])->withErrors($validator)->withInput();
            }
        }

        foreach ($data as $key => $value) {
            Skill::where(['id' => $id])->update([$key => $value]);
        }

        return redirect()->route('skills.index')->with(['success' => 'Skill alterado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = Skill::find($id);
        $skill->delete();

        return redirect()->route('skills.index')->with(['success' => 'Skill deletado com sucesso']);
    }
}
