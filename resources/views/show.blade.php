@extends('templates.template')

@section('content')
    <h1 class="text-center">Visualizar - DataFrete</h1>
    <hr>

    <div class="col-8 m-auto">
        ID: {{$distancia->id}}<br>
        Cep origem: {{$distancia->cep_origem}}<br>
        Cep destino: {{$distancia->cep_destino}}<br>
        Criado em: {{$distancia->created_at}}<br>
        Alterado em: {{$distancia->updated_at}}<br>
    </div>
@endsection