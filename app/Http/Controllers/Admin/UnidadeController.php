<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Cidade;
use App\Admin\Unidade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = DB::table('unidade')->select('unidade.*', 'cidade.nome as nomeCidade')->join('cidade', 'cidade.id', 'unidade.cidadeId')->where('unidade.deleted_at', '=', null)->get();


        $cidades = Cidade::all();
        return view('admin.unidade.index', ['unidades' => $unidades, 'cidades' => $cidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Unidade $unidade)
    {
        $request->validate([
            'nome' => 'required|max:30|min:3',
            'cidadeId' => 'required',
            'rua' => 'required|max:30|min:3',
            'numero' => 'required',
            'bairro' => 'required',
            'cep' => 'required'
        ]);

        if ($unidade->create($request->all())) {
            return redirect()->route('admin.unidade.index')->with('success', 'Unidade cadastrada com sucesso!');
        } else {
            return redirect()->route('admin.unidade.index')->with('danger', 'Erro ao cadastrar unidade!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = DB::table('unidade')->select('unidade.nome', 'unidade.rua', 'unidade.numero', 'unidade.bairro', 'unidade.cep', 'cidade.nome as nomeCidade', 'estado.nome as nomeEstado')->join('cidade',  'cidade.id', 'unidade.cidadeId')->join('estado', 'estado.id', 'cidade.estadoId')->get();

        return view('admin.unidade.show', ['unidade' => $unidade]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidade $unidade)
    {
        $cidades = Cidade::all();

        return view('admin.unidade.edit', ['unidade' => $unidade, 'cidades' => $cidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidade $unidade)
    {

        $request->validate([
            'nome' => 'required|max:30|min:3',
            'cidadeId' => 'required',
            'rua' => 'required|max:30|min:3',
            'numero' => 'required',
            'bairro' => 'required',
            'cep' => 'required'
        ]);


        if($unidade->update($request->all())) {
            return redirect()->route('admin.unidade.index')->with('success', 'Dados de Unidade atualizado com sucesso!');
        } else {
            return redirect()->route('admin.unidade.index')->with('danger', 'Erro ao atualizar dados de unidade!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        if ($unidade->delete()) {
            return redirect()->route('admin.unidade.index')->with('success', 'Unidade Removida com sucesso!');
        }else {
            return redirect()->route('admin.unidade.index')->with('danger', 'Erro ao remover unidade!');
        }
    }
}
