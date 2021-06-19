@extends('templates.template')

@section('content')
    <h1 class="text-center">DataFrete</h1>
    <hr>

    <div class="text-center mb-4 mt-3">
        <a href="">
            <button class="btn btn-success">Cadastrar</button>
        </a>
    </div>

    <div class="col-8 m-auto">
        <table class="table text-center">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Cep de Origem</th>
                <th scope="col">Cep de Destino</th>
                <th scope="col">Distância (km)</th>
                <th scope="col">Funções</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($distancias as $distancia)
                <tr>
                    <th scope="row">{{ $distancia->id }}</th>
                    <td>{{ $distancia->cep_origem }}</td>
                    <td>{{ $distancia->cep_destino }}</td>
                    <td>{{ $distancia->distancia }}</td>
                    <td>
                        <a href="{{url("datafrete/$distancia->id")}}">
                            <button class="btn btn-dark">Visualizar</button>
                        </a>
                        
                        <a href="">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                        
                        <a href="">
                            <button class="btn btn-danger">Deletar</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
    </div>
@endsection