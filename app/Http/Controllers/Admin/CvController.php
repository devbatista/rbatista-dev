<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Cv;

class CvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.cv.index');
    }

    public function update(Request $request)
    {
        $cv = Cv::first();
        $data = $request->only(['cv']);

        $validator = Validator::make($data, [
            'cv' => 'required|file|mimes:pdf,doc,docx'
        ]);

        if ($validator->fails()) {
            return redirect()->route('cv')->withErrors($validator)->withInput();
        }


        $file = 'cv.' . $data['cv']->extension();
        $data['cv']->storeAs('public/cv', $file);
        $data['cv'] = $file;

        if ($cv) {
            $retorno = $this->store($data['cv'], $cv->id);
        } else {
            $retorno = $this->insert($data['cv']);
        }

        return redirect()->route('cv')->with(['success' => $retorno]);
    }

    private function insert($data)
    {
        $cv = new Cv();
        $cv->nome = $data;
        $cv->save();

        return 'CV inserido com sucesso';
    }

    private function store($cv, $id)
    {
        Cv::where(['id' => $id])->update(['nome' => $cv]);

        return 'CV alterado com sucesso';
    }
}
