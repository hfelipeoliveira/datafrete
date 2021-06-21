@extends('templates.template')

@section('content')
    <h1 class="text-center"><a href="/datafrete">DataFrete</a> - @if(isset($distancia)) Editar @else Cadastrar @endif</h1>
    <hr>

    <div class="col-8 m-auto">
        @if(isset($distancia))
        <!-- Editar -->
        <form name="formCad" id="formCad" method="post" action="{{url("datafrete/$distancia->id")}}">
            @method('PUT')
            @csrf
            <input value="{{ Str::cep($distancia->cep_origem) }}" autocomplete="off" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_origem" id="cep_origem" placeholder="CEP de origem" required>
            <div id="feedback-cep-origem">CEP válido
            @if($errors->has('cep_origem'))
                {{ $errors->first('cep_origem') }}
            @endif
            </div>
            <div id="coordenadas-cep-origem"></div>
            <br>
            <input value="{{ Str::cep($distancia->cep_destino) }}" autocomplete="off" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_destino" id="cep_destino" placeholder="CEP de destino" required>
            <div id="feedback-cep-destino">CEP válido
            @if($errors->has('cep_destino'))
                {{ $errors->first('cep_destino') }}
            @endif
            </div>
            <div id="coordenadas-cep-destino"></div>
            <br>
            <input value="{{ number_format($distancia->distancia, 2) }}" autocomplete="off" class="form-control" type="text" name="distancia" id="distancia" placeholder="Distância"  required readonly>
            <br>
            <input class="btn btn-primary" id="btn-enviar" type="submit" value="Cadastrar">
        </form>
        @else
        <!-- Cadastrar -->
        <form name="formCad" id="formCad" method="post" action="{{url('datafrete')}}">
            @csrf
            <input value="{{ old('cep_origem') }}" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_origem" id="cep_origem" placeholder="CEP de origem" required>
            <div id="feedback-cep-origem">
            @if($errors->has('cep_origem'))
                {{ $errors->first('cep_origem') }}
            @endif
            </div>
            <div id="coordenadas-cep-origem"></div>
            <br>
            <input value="{{ old('cep_destino') }}" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_destino" id="cep_destino" placeholder="CEP de destino" required>
            <div id="feedback-cep-destino">
            @if($errors->has('cep_destino'))
                {{ $errors->first('cep_destino') }}
            @endif
            </div>
            <div id="coordenadas-cep-destino"></div>
            <br>
            <input value="" autocomplete="off" class="form-control" type="text" name="distancia" id="distancia" placeholder="Distância" required readonly>
            <div id="feedback-distancia">
            @if($errors->has('distancia'))
                {{ $errors->first('distancia') }}
            @endif
            </div>
            <br>
            <input class="btn btn-primary" id="btn-enviar" type="submit" value="Cadastrar">
        </form>
        @endif
    </div>
@endsection