@extends('templates.template')

@section('content')
    <h1 class="text-center"><a href="/datafrete">DataFrete</a> - Visualizar</h1>
    <hr>

    <div class="col-8 m-auto">
        ID: {{$distancia->id}}<br>
        Cep origem: {{ Str::cep($distancia->cep_origem) }}<br>
        Cep destino: {{ Str::cep($distancia->cep_destino) }}<br>
        Distância: {{ number_format($distancia->distancia, 2) }} Km<br>
        Criado em: {{ date( 'd/m/Y H:i:s' , strtotime($distancia->created_at))}}<br>
        Alterado em: {{date( 'd/m/Y H:i:s' , strtotime($distancia->updated_at))}}<br>
    </div>
@endsection