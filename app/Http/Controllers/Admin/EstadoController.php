<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Estado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::all();


        return view('admin.estado.index', ['estados' => $estados]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Estado $estado)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        $estado->nome = $request->nome;

        if ($estado->save()) {
            return redirect()->route('admin.estado.index')->with('success', 'Estado cadastrado com sucesso!');
        } else {
            return redirect()->route('admin.estado.index')->with('danger', 'Erro ao cadastrar o estado!');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        return view('admin.estado.edit', ['estado'=> $estado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        $estado->nome = $request->nome;

        if ($estado->update()) {
            return redirect()->route('admin.estado.index')->with('success', 'Dados Atualizados com sucesso!');
        } else {
            return redirect()->route('admin.estado.index')->with('danger', 'Erro ao atualizar dados do estado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        if ($estado->delete()) {
            return redirect()->route('admin.estado.index')->with('success', 'Estado excluido com sucesso!');
        }else{
            return redirect()->route('admin.estado.index')->with('danger', 'Erro ao excluir dado!');
        }
    }
}
