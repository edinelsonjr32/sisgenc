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
                        Gerenciamento de Usuário
                    </div>
                </div>
                <div class="card-body ">
                    <a  class="btn btn-primary col-md-2 offset-10" href="{{route('admin.usuario.index')}}">
                        Voltar
                    </a>
                    <br><br>

                    <form class="form-controll" method="POST" action="{{route('admin.usuario.update', $usuario->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                                            <label for="name" class="text-black-50">Nome</label>
                                            <input type="name" class="form-control" id="name" aria-describedby="name"
                                                placeholder="Adicione o nome do Tipo" name="name" value="{{$usuario->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipoUsuarioId" class="text-black-50">Tipo Usuário</label>
                                                    <select class="form-control" id="estado" name="tipoUsuarioId">
                                                        @foreach ($tipo as $item)
                                                            <option value="{{$item->id}}" {{old('tipoUsuarioId') == $item->id ? 'selected' : ($usuario->tipoUsuarioId == $item->id ? 'selected' : '')}}>{{$item->nome}}</option>
                                                        @endforeach
                                                    </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="unidadeId" class="text-black-50">Unidade</label>
                                            <select class="form-control" id="unidadeId" name="unidadeId">
                                                @foreach ($unidade as $item)
                                                    <option value="{{$item->id}}" {{old('unidadeId') == $item->id ? 'selected' : ($usuario->unidadeId == $item->id ? 'selected' : '')}}>{{$item->nome}}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="text-black-50">Email</label>
                                            <input type="email" class="form-control" id="email" aria-describedby="email"
                                                placeholder="Adicione seu email" name="email" value="{{$usuario->email}}">

                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-black-50">Senha</label>
                                            <input type="password" class="form-control" id="password" aria-describedby="password"
                                                placeholder="Adicione sua senha" name="password" >
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
