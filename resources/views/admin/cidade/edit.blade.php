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
                        Gerenciamento de Cidade
                    </div>
                </div>
                <div class="card-body ">
                    <a  class="btn btn-primary col-md-2 offset-10" href="{{route('admin.cidade.index')}}">
                        Voltar
                    </a>
                    <br><br>

                    <form class="form-controll" method="POST" action="{{route('admin.cidade.update', $cidade->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nome" class="text-black-50">Nome</label>
                            <input type="name" class="form-control" id="nome" aria-describedby="nome" placeholder="Adicione o nome do Tipo"
                                name="nome" value="{{$cidade->nome}}">
                        </div>
                        <div class="form-group">
                            <label for="nome" class="text-black-50">Estado</label>
                            <select class="form-control" id="estado" name="estadoId">
                                @foreach ($estados as $item)
                                <option value="{{$item->id}}" {{old('estadoId') == $item->id ? 'selected' : ($cidade->estadoId == $item->id ? 'selected' : '')}}>{{$item->nome}}</option>
                                @endforeach
                            </select>

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
