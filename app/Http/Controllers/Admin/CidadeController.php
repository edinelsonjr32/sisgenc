<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Cidade;
use App\Admin\Estado;
use App\Admin\Unidade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidade = DB::table('cidade')->select('cidade.nome', 'cidade.id', 'estado.nome as nomeEstado')->join('estado', 'estado.id', 'cidade.estadoId')->where('cidade.deleted_at', '=', null)->paginate(15);

        $estados = Estado::all();

        return view('admin.cidade.index', ['cidade' => $cidade, 'estados' => $estados]);
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
    public function store(Request $request, Cidade $cidade)
    {
        $request->validate(
            [
                'nome' => 'required',
                'estadoId' => 'required'
            ]
        );

        $cidade->nome = $request->nome;
        $cidade->estadoId = $request->estadoId;

        if ($cidade->save()) {
            return redirect()->route('admin.cidade.index')->with('success', 'Cidade Cadastrada com sucesso!');
        }else{
            return redirect()->route('admin.cidade.index')->with('danger', 'Erro ao cadastrar cidade!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cidade $cidade)
    {

        $estados = Estado::all();

        return view('admin.cidade.edit', ['cidade'=> $cidade, 'estados' =>$estados ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cidade $cidade)
    {
        if($cidade->update($request->all())){
            return redirect()->route('admin.cidade.index')->with('success', 'Dados de cidade atualizado com sucesso!');
        }else{
            return redirect()->route('admin.cidade.index')->with('danger', 'Erro ao editar dados de cidade!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cidade $cidade)
    {
        if ($cidade->delete()) {
            return redirect()->route('admin.cidade.index')->with('success', 'Cidade removida com sucesso!');
        }else{
            return redirect()->route('admin.cidade.index')->with('danger', 'Erro ao remover cidade!');
        }

    }
}
