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
                                    <h5 class="modal-title text-black-50" id="exampleModalLabel">Adicionar Unidade
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="form-controll" method="POST" action="{{route('admin.unidade.store')}}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="nome" class="text-black-50">Nome</label>
                                            <input type="name" class="form-control" id="nome" aria-describedby="nome"
                                                placeholder="Adicione o nome da unidade" name="nome">

                                        </div>
                                        <div class="form-group">
                                            <label for="nome" class="text-black-50">Cidade</label>
                                            <select class="form-control" id="cidade" name="cidadeId">
                                                @foreach ($cidades as $item)
                                                    <option value="{{$item->id}}">{{$item->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nome" class="text-black-50">Rua</label>
                                            <input type="name" class="form-control" id="nome" aria-describedby="nome"
                                                placeholder="Rua" name="rua">

                                        </div>
                                        <div class="form-group">
                                            <label for="nome" class="text-black-50">Número</label>
                                            <input type="name" class="form-control" id="nome" aria-describedby="nome"
                                                placeholder="Número" name="numero">

                                        </div>
                                        <div class="form-group">
                                            <label for="nome" class="text-black-50">CEP</label>
                                            <input type="name" class="form-control" id="cep" aria-describedby="cep"
                                                placeholder="CEP" name="cep">

                                        </div>
                                        <div class="form-group">
                                            <label for="nome" class="text-black-50">Bairro</label>
                                            <input type="name" class="form-control" id="nome" aria-describedby="nome"
                                                placeholder="Bairro" name="bairro">

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
                    @if ($unidades == '[]')
                    <div class="alert alert-secondary" role="alert">
                        Sem dados
                    </div>
                    @elseif($unidades !== '[]')
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th width="40%">Nome</th>
                                <th width="25%">Cidade</th>
                                <th width="10%">Status</th>
                                <th width="15%">-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidades as $dado)
                            <tr>
                                <td>{{$dado->nome}}</td>
                                <td>{{$dado->nomeCidade}}</td>
                                <td>
                                    @if ($dado->status == 1)
                                        Ativo
                                    @else
                                        Inativo
                                    @endif
                                </td>
                                <td class="">
                                    @if ($dado->id)
                                    <form action="{{ route('admin.unidade.destroy', $dado->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('admin.unidade.show', $dado->id)}}" class="btn btn-md bg-warning text-white">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{route('admin.unidade.edit', $dado->id)}}"
                                            class="btn btn-md bg-success text-white">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        <button type="button" href="#" class="btn btn-md bg-danger text-white"
                                            onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                            <i class="fa fa-trash "></i>
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{route('admin.unidade.edit', $dado->id)}}"
                                        class="btn btn-md bg-success text-white">
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
