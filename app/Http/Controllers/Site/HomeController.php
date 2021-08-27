<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\SendRegisterMessage;
use App\Models\Academico;
use App\Models\Skill;
use App\Models\Experiencia;
use App\Models\Perfil;
use App\Models\Portfolio;
use App\Models\RedesSociais;
use App\Models\Seo;
use App\Models\Cv;
use App\Models\Mensagem;

class HomeController extends Controller
{
    public function index()
    {
        $dados = [
            'perfil' => $this->getProfile(),
            'redesSociais' => $this->getRedesSociais(),
            'skills' => $this->getSkills(),
            'experiencias' => $this->getExperiencias(),
            'academico' => $this->getAcademico(),
            'portfolio' => $this->getPortfolio(),
            'seo' => $this->getSeo(),
            'cv' => $this->getCv(),
        ];

        return view('index', $dados);
    }

    public function mensagem(Request $request)
    {
        $data = $request->only(['nome', 'telefone', 'email', 'mensagem']);

        $validator = Validator::make($data, [
            'nome' => 'required|string|max:50',
            'telefone' => 'required',
            'email' => 'required|email|max:50',
            'mensagem' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/#contact')->withErrors($validator)->withInput();
        }

        $mensagem = new Mensagem();
        $mensagem->nome = $data['nome'];
        $mensagem->telefone = $data['telefone'];
        $mensagem->email = $data['email'];
        $mensagem->mensagem = $data['mensagem'];
        $mensagem->save();

        if ($mensagem->id) {
            $retorno = ['success' => 'Mensagem enviada com sucesso'];
            Mail::send(new SendRegisterMessage());
        } else {
            $retorno = ['error' => 'Falha no envio da mensagem, tente novamente'];
        }

        return redirect('/#contact')->with($retorno)->withInput();
    }

    private function getProfile()
    {
        $perfil = Perfil::first();

        $localidade = explode('-', $perfil['endereco']);
        $perfil['localidade'] = trim($localidade[2]);
        $perfil['idade'] = $this->calcularIdade($perfil['dt_nascimento']);
        $perfil['foto'] = asset('assets/images/' . $perfil['foto']);
        $perfil['whatsapp'] = str_replace(['+', '-', ' '], '', $perfil->telefone);

        return $perfil;
    }

    private function getRedesSociais()
    {
        $redesSociais = RedesSociais::all();

        return $redesSociais;
    }

    private function getSkills()
    {
        $skills = Skill::all();

        return $skills;
    }

    private function getExperiencias()
    {
        $experiencias = Experiencia::orderBy('id', 'desc')->get();

        return $experiencias;
    }

    private function getAcademico()
    {
        $academico = Academico::orderBy('id', 'desc')->get();

        return $academico;
    }

    private function getPortfolio()
    {
        $portfolio = Portfolio::orderBy('id', 'desc')->limit(6)->get();
        $cont = 0;

        foreach ($portfolio as $item) {
            $portfolio[$cont]['thumb'] = asset(Storage::url('portfolio/' . $item['thumb']));
            $cont++;
        }

        return $portfolio;
    }

    private function getSeo()
    {
        $seoReturn = Seo::first();

        $seo = ($seoReturn) ? $seoReturn : (object)[];

        $seo->descricao = (isset($seo->descricao) && $seo->descricao != null) ? $seo->descricao : '';
        $seo->keywords = (isset($seo->keywords) && $seo->keywords != null) ? $seo->keywords : '';
        $seo->autor = (isset($seo->autor) && $seo->autor != null) ? $seo->autor : '';
        $seo->og_imagem = (isset($seo->og_imagem) && $seo->og_imagem != null) ? asset(Storage::url('og/' . $seo->og_imagem)) : '';
        $seo->og_descricao = (isset($seo->og_descricao) && $seo->og_descricao != null) ? $seo->og_descricao : '';

        return $seo;
    }

    private function getCv()
    {
        $cv = Cv::first();
        $cv['nome'] = asset(Storage::url('cv/' . $cv['nome']));

        return $cv;
    }

    private function calcularIdade($nascimento)
    {
        $hoje = getdate();
        $dtNascimento = explode('-', $nascimento);
        $idade = $hoje['year'] - $dtNascimento[0];

        if ($hoje['mon'] < $dtNascimento[1] || ($hoje['mon'] == $dtNascimento[1] && $hoje['mday'] < $dtNascimento[2])) {
            $idade -= 1;
        }

        return $idade;
    }
}
