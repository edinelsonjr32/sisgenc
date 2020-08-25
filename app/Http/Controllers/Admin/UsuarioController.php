<?php

namespace App\Http\Controllers\Admin;

use App\Admin\TipoUsuario;
use App\Admin\Unidade;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo = TipoUsuario::all();
        $unidade = Unidade::all();

        $usuarios = DB::table('users')->select('users.*', 'unidade.nome as nomeUnidade', 'tipo_usuario.nome as nomeTipoUsuario')->join('unidade', 'unidade.id', 'users.unidadeId')->join('tipo_usuario', 'tipo_usuario.id', 'users.tipoUsuarioId')->get();

        return view('admin.usuario.index', ['tipo' => $tipo, 'unidade' => $unidade, 'usuarios' => $usuarios]);
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
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'unidadeId' => 'required',
            'tipoUsuarioId' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);


        if ($request->password == $request->confirm_password) {
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->tipoUsuarioId = $request->tipoUsuarioId;
            $user->unidadeId = $request->unidadeId;

            $user->save();
            return redirect()->route('admin.usuario.index')->with('success', 'Dados Cadastrados com sucesso');
        } else {
            return redirect()->route('admin.usuario.index')->with('danger', 'Erro senhas diferentes');
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
    public function edit($id, User $user)
    {
        $usuario = $user->find($id);
        $tipo = TipoUsuario::all();
        $unidade = Unidade::all();
        return view('admin.usuario.edit', compact('usuario', 'tipo', 'unidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        if ($request->password == null) {

        }else {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->tipoUsuarioId = $request->tipoUsuarioId;
        $usuario->unidadeId = $request->unidadeId;

        if ($usuario->update()) {
            return redirect()->route('admin.usuario.index')->with('success', 'Dados Atualizados com sucesso!');
        }else {
            return redirect()->route('admin.usuario.index')->with('error', 'Erro ao atualizar dados!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);


        if ($usuario->delete()) {
            return redirect()->route('admin.usuario.index')->with('success','Dados removido com sucesso!');
        }else{
            return redirect()->route('admin.usuario.index')->with('danger', 'Erro na remoção de usuário');
        }
    }
}
