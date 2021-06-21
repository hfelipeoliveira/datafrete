@extends('templates.template')

@section('content')
    <h1 class="text-center">DataFrete - @if(isset($distancia)) Editar @else Cadastrar @endif</h1>
    <hr>

    <div class="col-8 m-auto">
        @if(isset($distancia))
        <form name="formCad" id="formCad" method="post" action="{{url("datafrete/$distancia->id")}}">
            @method('PUT')
            @csrf
            <input value="{{ Str::cep($distancia->cep_origem) }}" autocomplete="off" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_origem" id="cep_origem" placeholder="CEP de origem" required>
            <div id="feedback-cep-origem">CEP válido
            @if($errors->has('cep_origem'))
                {{ $errors->first('cep_origem') }}
            @endif
            </div>
            <br>
            <input value="{{ Str::cep($distancia->cep_destino) }}" autocomplete="off" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_destino" id="cep_destino" placeholder="CEP de destino" required>
            <div id="feedback-cep-destino">CEP válido
            @if($errors->has('cep_destino'))
                {{ $errors->first('cep_destino') }}
            @endif
            </div>
            <br>
            <input value="{{ number_format($distancia->distancia, 2) }}" class="form-control" disabled>
            <br>
            <input class="btn btn-primary" id="btn-enviar" type="submit" value="Cadastrar">
        </form>
        @else
        <form name="formCad" id="formCad" method="post" action="{{url('datafrete')}}">
            @csrf
            <input value="{{ old('cep_origem') }}" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_origem" id="cep_origem" placeholder="CEP de origem" required>
            <div id="feedback-cep-origem">
            @if($errors->has('cep_origem'))
                {{ $errors->first('cep_origem') }}
            @endif
            </div>
            <br>
            <input value="{{ old('cep_destino') }}" autocomplete="off" data-mask="00000-000" class="form-control" type="text" name="cep_destino" id="cep_destino" placeholder="CEP de destino" required>
            <div id="feedback-cep-destino">
            @if($errors->has('cep_destino'))
                {{ $errors->first('cep_destino') }}
            @endif
            </div>
            <br>
            <input class="btn btn-primary" id="btn-enviar" type="submit" value="Cadastrar">
        </form>
        @endif
    </div>
@endsection