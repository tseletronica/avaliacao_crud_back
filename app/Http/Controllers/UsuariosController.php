<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->cpf){
            $usuarios=Usuarios::where("cpf_cnpj","=",$request->cpf)->get();
            return response()->json(["usuarios" => $usuarios]);
        }
        if($request->maior_idade){
            $usuarios = DB::select("SELECT * FROM usuarios where data_nascimento <= '2003-12-31'");
            return response()->json(["usuarios" => $usuarios]);
                }
        $usuarios = Usuarios::all();
        return response()->json(["usuarios" => $usuarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $usuario = new Usuarios;
            $usuario->nome = $request->nome;
            $usuario->cpf_cnpj = $request->cpf_cnpj;
            $usuario->telefone = $request->telefone;
            $usuario->email = $request->email;
            $usuario->senha = $request->senha;
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->endereco = $request->endereco;

            $usuario->save();
            return response()->json(["Sucesso" => "Usuário salvo com sucesso"]);
        } catch (Exception $erro) {
            return response()->json(["Erro" => "Não foi possivel salvar os dados", "debug" => $erro],400);
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
        $usuario = Usuarios::find($id);
        return response()->json(["usuario" => $usuario]);
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
        try {
            $usuario = Usuarios::find($id);
            $usuario->nome = $request->nome;
            $usuario->cpf_cnpj = $request->cpf_cnpj;
            $usuario->telefone = $request->telefone;
            $usuario->email = $request->email;
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->endereco = $request->endereco;
            $usuario->save();
            return response()->json(["Sucesso" => "Usuário  atualizado com sucesso"]);
        } catch (Exception $erro) {
            return response()->json(["Erro" => "Não foi possivel atualizar os dados", "debug" => $erro]);
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
        try{
            $usuario = Usuarios::find($id);
            $usuario->delete();
            return response()->json(["sucesso" => "Usuário deletado com sucesso"]);

        }catch(Exception $erro){
            return response()->json(["Erro" => "Não foi possivel atualizar os dados", "debug" => $erro]);

        }

       
    }
}
