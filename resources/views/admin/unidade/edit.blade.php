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

                    <form class="form-controll" method="POST" action="{{route('admin.unidade.update', $unidade->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nome" class="text-black-50">Nome</label>
                            <input type="name" class="form-control" id="nome" aria-describedby="nome" placeholder="Adicione o nome da unidade"
                                name="nome" value="{{$unidade->nome}}">

                        </div>
                        <div class="form-group">
                            <label for="nome" class="text-black-50">Cidade</label>
                            <select class="form-control" id="cidade" name="cidadeId">
                                @foreach ($cidades as $item)
                                <option value="{{$item->id}}" {{old('cidadeId') == $item->id ? 'selected' : ($unidade->cidadeId == $item->id ? 'selected' : '')}}>{{$item->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nome" class="text-black-50">Rua</label>
                            <input type="name" class="form-control" id="nome" aria-describedby="nome" placeholder="Rua" name="rua" value="{{$unidade->rua}}">

                        </div>
                        <div class="form-group">
                            <label for="nome" class="text-black-50">Número</label>
                            <input type="name" class="form-control" id="nome" aria-describedby="nome" placeholder="Número" name="numero" value="{{$unidade->numero}}">

                        </div>
                        <div class="form-group">
                            <label for="nome" class="text-black-50">CEP</label>
                            <input type="name" class="form-control" id="cep" aria-describedby="cep" placeholder="CEP" name="cep" value="{{$unidade->cep}}">

                        </div>
                        <div class="form-group">
                            <label for="nome" class="text-black-50">Bairro</label>
                            <input type="name" class="form-control" id="nome" aria-describedby="nome" placeholder="Bairro" name="bairro" value="{{$unidade->bairro}}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
