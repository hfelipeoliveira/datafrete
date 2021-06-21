<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distancia;

class DistanciaController extends Controller
{

    //  Exibe a index
    public function index()
    {
        $distancias = Distancia::orderBy('id', 'DESC')->paginate(20);
        return view('index', compact('distancias'));
    }

    //  View create
    public function create()
    {
        return view('create');
    }

    //  Salva uma nova distância
    public function store(Request $request)
    {
        $cepOrigem = str_replace("-", "", $request->get('cep_origem'));
        $cepDestino = str_replace("-", "", $request->get('cep_destino'));
        $regras = [
            'cep_origem' => 'required|min:9|max:9',
            'cep_destino' => 'required|min:9|max:9',
            'distancia' => 'required'
        ];

        $feedback = [
            'cep_origem.min' => 'CEP inválido',
            'cep_origem.max' => 'CEP inválido',

            'cep_destino.min' => 'CEP inválido',
            'cep_destino.max' => 'CEP inválido',
            'required' => 'Campo obrigatório'
        ];

        $request->validate(
            $regras, $feedback
            );
        
        $cadastro = Distancia::create([
            'cep_origem'=>$cepOrigem,
            'cep_destino'=>$cepDestino,
            'distancia'=>$request->get('distancia')
        ]);

        if($cadastro){
            return redirect('datafrete');
        }
    }

    //  View para exibir uma distância já calculada
    public function show($id)
    {
        $distancia=Distancia::find($id);
        return view('show',compact('distancia'));
    }

    //  View para edita
    public function edit($id)
    {
        $distancia = Distancia::find($id);
        return view('create', compact('distancia'));
    }

    //  Salva a edição
    public function update(Request $request, $id)
    {
        $cepOrigem = str_replace("-", "", $request->get('cep_origem'));
        $cepDestino = str_replace("-", "", $request->get('cep_destino'));
        $regras = [
            'cep_origem' => 'required|min:9|max:9',
            'cep_destino' => 'required|min:9|max:9',
            'distancia' => 'required'
        ];

        $feedback = [
            'cep_origem.min' => 'CEP inválido',
            'cep_origem.max' => 'CEP inválido',

            'cep_destino.min' => 'CEP inválido',
            'cep_destino.max' => 'CEP inválido',
            'required' => 'Campo obrigatório'
        ];

        $request->validate(
            $regras, $feedback
            );

        Distancia::where(['id'=>$id])->update([
            'cep_origem'=>$cepOrigem,
            'cep_destino'=>$cepDestino,
            'distancia'=>$request->get('distancia')
        ]);
        return redirect('datafrete');
    }

    //  Deleta uma distância calculada
    public function destroy($id)
    {
        return (Distancia::destroy($id) ? "Sim" : "Não");
    }
}
