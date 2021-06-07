<?php

namespace App\Http\Controllers;

use App\Carrinho;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CarrinhoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


     protected $jwt;


    public function __construct(JWTAuth $jwt)
    {
         $this->jwt = $jwt;
        $this->middleware('auth:api', [
                    'except' => ['usuarioLogin', 'cadastrarUsuario']
        ]);
    }

     public function listarCarrinho(){


        return response()->json(Carrinho::all());


     }

       public function cadastrarCarrinho(Request $request){

      $carrinho = $this->validate($request, [

        'id_pedido' =>  'required', 
        'id_carrinho'  => 'required',
        'quantidade' => 'required|numeric'

    ]);

       $criado = Carrinho::create($carrinho);

       if($criado){

        return response()->json(['mensagem'=>'Cadastrado com sucesso!'],200);

       }else{

         return response()->json(['mensagem'=>'Falha ao cadastrar!'],400);
       }
       


     }


      public function atualizarCarrinho(Request $request, $id){

      $carrinho = $this->validate($request, [

        'nome' =>  'required', 
        'descricao'  => 'required',
        'estoque' => 'required|integer',
        'preco' => 'required|numeric'

    ]);

       $dados = Carrinho::Find($id);
       $dados->update($carrinho);



        return response()->json(['mensagem'=>'Atualizado com sucesso!'],200);


     }


     public function  selecionarCarrinho($id){

  
    $dados = Carrinho::Find($id);
      // var_dump($dados);

     return response()->json($dados);
     
     }

      public function excluirCarrinho ($id){

      

       $dados = Carrinho::Find($id);
     //  $dados->destroy($id);

       $deletado=$dados->destroy($id);

    if($deletado){
        return response()->json(['mensagem'=>'Excluido com sucesso!'],200);



}else{



   return response()->json(['mensagem'=>'Falha ao Excluir!'],400);
}

     }


}
