<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distancia;

class DistanciaController extends Controller
{

    private $objDistancia;

    public function __construct()
    {
        $this->objDistancia = new Distancia();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distancias = Distancia::orderBy('id', 'DESC')->paginate(20);
        return view('index', compact('distancias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cepOrigem = str_replace("-", "", $request->get('cep_origem'));
        $cepDestino = str_replace("-", "", $request->get('cep_destino'));
        $regras = [
            'cep_origem' => 'required|min:9|max:9',
            'cep_destino' => 'required|min:9|max:9'
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
            'distancia'=>10.00
        ]);

        if($cadastro){
            return redirect('datafrete');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distancia=Distancia::find($id);
        return view('show',compact('distancia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distancia = Distancia::find($id);
        return view('create', compact('distancia'));
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
        $cepOrigem = str_replace("-", "", $request->get('cep_origem'));
        $cepDestino = str_replace("-", "", $request->get('cep_destino'));
        $regras = [
            'cep_origem' => 'required|min:9|max:9',
            'cep_destino' => 'required|min:9|max:9'
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
            'distancia'=>10.01
        ]);
        return redirect('datafrete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Distancia::destroy($id) ? "Sim" : "Não");
    }
}
