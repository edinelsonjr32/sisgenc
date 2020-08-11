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
                        Gerenciamento de Estados
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
                                    <h5 class="modal-title text-black-50" id="exampleModalLabel">Adicionar Estado
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="form-controll" method="POST"
                                    action="{{route('admin.estado.store')}}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="nome" class="text-black-50">Nome</label>
                                            <input type="name" class="form-control" id="nome" aria-describedby="nome"
                                                placeholder="Adicione o nome do Tipo" name="nome">
                                            <small id="emailHelp" class="form-text text-muted">Evite colocar caracteres
                                                especiais</small>
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
                    @if ($estados == '[]')
                    <div class="alert alert-secondary" role="alert">
                        Sem dados
                    </div>
                    @else
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th width="80%">Nome</th>
                                <th width="10%">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estados as $dado)
                            <tr>
                                <td>{{$dado->nome}}</td>
                                <td class="">
                                    @if ($dado->id)
                                    <form action="{{ route('admin.estado.destroy', $dado) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('admin.estado.edit', $dado)}}" class="btn btn-md bg-success text-white">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        <button type="button" href="#" class="btn btn-md bg-danger text-white" onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                            <i class="fa fa-trash "></i>
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{route('admin.estado.edit', $dado)}}" class="btn btn-md bg-success text-white">
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
