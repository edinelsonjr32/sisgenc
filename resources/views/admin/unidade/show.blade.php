@extends('admin.layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @elseif($message = Session::get('danger'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-header  bg-success mb-3">
                    <div class="row">
                        Gerenciamento de Unidade
                    </div>
                </div>
                <div class="card-body ">
                    <a  class="btn btn-primary col-md-2 offset-10" href="{{route('admin.unidade.index')}}">
                        Voltar
                    </a>
                    <br><br>

                    <ul class="list-group">
                        @foreach ($unidade as $item)
                            <li class="list-group-item active">Dados Unidade <i class="fa fa-home"></i></li>
                            <li class="list-group-item">Nome: {{$item->nome}}</li>
                            <li class="list-group-item">Cidade: {{$item->nomeCidade}}-{{$item->nomeEstado}}</li>
                            <li class="list-group-item">Endereço: {{$item->rua}}, N° {{$item->numero}}, Bairro: {{$item->bairro}}</li>
                            <li class="list-group-item">CEP: {{$item->cep}}</li>
                        @endforeach

                    </ul>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
