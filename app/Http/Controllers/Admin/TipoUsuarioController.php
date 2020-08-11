<?php

namespace App\Http\Controllers\Admin;

use App\Admin\TipoUsuario;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoUsuarioRequest;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoUsuario::all();

        return view('admin.tipo_usuario.index', ['tipos' => $tipos]);
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
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:tipo_usuario|max:30',
        ]);

        $tipoUsuario = new TipoUsuario();
        $tipoUsuario->nome = $request->nome;

        if ($tipoUsuario->save()) {
            return redirect()->route('admin.tipo_usuario.index')->with('success', 'Tipo Usuário adicionado com sucesso!');
        }else{
            return redirect()->route('admin.tipo_usuario.index')->with('danger', 'Erro ao cadastrar o tipo usuário!');
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
    public function edit(TipoUsuario $tipoUsuario)
    {

        return view('admin.tipo_usuario.edit', ['tipoUsuario'=> $tipoUsuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoUsuario $tipoUsuario)
    {
        $request->validate([
            'nome'=> 'required'
        ]);

        $tipoUsuario->nome = $request->nome;
        $tipoUsuario->save();

        return redirect()->route('admin.tipo_usuario.index')->with('success', 'Dados atualizados com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoUsuario $tipoUsuario)
    {
        $tipoUsuario->delete();

        return redirect()->route('admin.tipo_usuario.index')->with('success', 'Registro removido com sucesso!');
    }
}
