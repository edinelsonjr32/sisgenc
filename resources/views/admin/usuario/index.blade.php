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
                    <button type="button" class="btn btn-primary col-md-2 offset-10" data-toggle="modal"
                        data-target="#exampleModal">
                        Adicionar
                    </button>
                    <br><br>



                    <!-- Modal -->
                    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black-50" id="exampleModalLabel">Adicionar Usuário
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="form-controll" method="POST"
                                    action="{{route('admin.usuario.store')}}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="name" class="text-black-50">Nome</label>
                                            <input type="name" class="form-control" id="name" aria-describedby="name"
                                                placeholder="Adicione o nome do Tipo" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipoUsuarioId" class="text-black-50">Tipo Usuário</label>
                                            <select class="form-control" id="estado" name="tipoUsuarioId">
                                                @foreach ($tipo as $item)
                                                    <option value="{{$item->id}}">{{$item->nome}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="unidadeId" class="text-black-50">Unidade</label>
                                            <select class="form-control" id="unidadeId" name="unidadeId">
                                                @foreach ($unidade as $item)
                                                    <option value="{{$item->id}}">{{$item->nome}} </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="text-black-50">Email</label>
                                            <input type="email" class="form-control" id="email" aria-describedby="email"
                                                placeholder="Adicione seu email" name="email">

                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-black-50">Senha</label>
                                            <input type="password" class="form-control" id="password" aria-describedby="password"
                                                placeholder="Adicione sua senha" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password" class="text-black-50">Senha</label>
                                            <input type="password" class="form-control" id="confirm_password" aria-describedby="confirm_password"
                                                placeholder="Confirme sua senha" name="confirm_password">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if ($usuarios == '[]')
                    <div class="alert alert-secondary" role="alert">
                        Sem dados
                    </div>
                    @elseif($usuarios !== '[]')
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th width="40%">Nome</th>
                                <th width="20%">Unidade</th>
                                <th width="20%">Tipo Usuário</th>
                                <th width="20%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $dado)
                            <tr>
                                <td>{{$dado->name}}</td>
                                <td>{{$dado->nomeUnidade}}</td>
                                <td>{{$dado->nomeTipoUsuario}}</td>
                                <td class="">
                                    @if ($dado->id)
                                    <form action="{{ route('admin.usuario.destroy', $dado->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('admin.usuario.edit', $dado->id)}}" class="btn btn-md bg-success text-white">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        <button type="button" href="#" class="btn btn-md bg-danger text-white" onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                            <i class="fa fa-trash "></i>
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{route('admin.usuario.edit', $dado->id)}}" class="btn btn-md bg-success text-white">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
