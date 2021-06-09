<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ProdutoService;

class ProdutoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected $service;

     protected $jwt;


    public function __construct(JWTAuth $jwt, ProdutoService $service)
    {
         $this->jwt = $jwt;

         $this->service = $service;


        $this->middleware('auth:api', [
                    'except' => ['usuarioLogin', 'cadastrarUsuario']
        ]);
    }

     public function listarProduto(){


        return response()->json(Produto::all());


     }

    public function getAll()
    {
       try {
            return response()->json($this->service->getAll(), Response::HTTP_OK);
       } catch (\Exception $e) {
           return $this->error($e->getMessage());
        }
    }


       public function cadastrarProduto(Request $request){

      $produto = $this->validate($request, [

        'nome' =>  'required', 
        'descricao'  => 'required',
        'estoque' => 'required|integer',
        'preco' => 'required|numeric'

    ]);

       $criado = Produto::create($produto);

       if($criado){

        return response()->json(['mensagem'=>'Cadastrado com sucesso!'],200);

       }else{

         return response()->json(['mensagem'=>'Falha ao cadastrar!'],400);
       }
       


     }


      public function atualizarProduto(Request $request, $id){

      $produto = $this->validate($request, [

        'nome' =>  'required', 
        'descricao'  => 'required',
        'estoque' => 'required|integer',
        'preco' => 'required|numeric'

    ]);

       $dados = Produto::Find($id);
       $dados->update($produto);




        return response()->json(['mensagem'=>'Atualizado com sucesso!'],200);



     }


     public function  selecionarProduto($id){


    $dados = Produto::Find($id);
     

     return response()->json($dados);

     }

      public function excluirProduto ($id){

      

       $dados = Produto::Find($id);
     

          $deletado=$dados->destroy($id);

    if($deletado){
        return response()->json(['mensagem'=>'Excluido com sucesso!'],200);

}else{

   return response()->json(['mensagem'=>'Falha ao Excluir!'],400);
}

     }


}
