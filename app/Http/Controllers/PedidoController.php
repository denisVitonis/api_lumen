<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Produto;
use App\Carrinho;



class PedidoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


     protected $jwt;

     protected $produto;

      protected $carrinho;

    public function __construct(JWTAuth $jwt, ProdutoController $produto, CarrinhoController $carrinho)
    {
         $this->jwt = $jwt;
        $this->middleware('auth:api', [
                    'except' => ['usuarioLogin', 'cadastrarUsuario']
        ]);


      $this->produto = $produto;

    }

     public function listarPedido(){


        return response()->json(Pedido::all());


     }

       public function cadastrarPedido(Request $request){


        
    //  json_decode($request);

      $pedido = $this->validate($request, [

        
        'data_compra'  => 'required|date|date_format:Y-m-d',
        'nome_comprador' => 'required',
        'valor_frete' => 'required|numeric',
        'status' => 'required',
        'item' =>'required|array'

    ]);




$criado = Pedido::create($pedido);
$last_insert_id = $criado->id;


$itens = $pedido['item'];

unset($pedido->item);
$count = count($itens);

$control= 0;
          foreach($itens as $values){

      $check= Produto::Find($values['id_produto']);

     $values['id_pedido'] = $last_insert_id;

         if(empty($check)) {

          echo $last_insert_id;

                        $dados=Pedido::find($last_insert_id);
                        $deletado=$dados->destroy($last_insert_id);


                     
                    return response()->json(['erro'=>'Produto não cadastrado'],404);


         die();


        } else{ 


                  if($values['quantidade'] > $check->estoque)
                  {
                       $dados=Pedido::find($last_insert_id);
                       $deletado=$dados->destroy($last_insert_id);

                        return response()->json(['erro'=>'Quantidade acima do estoque']);


                      die();



                  } else{


                Carrinho::create($values);
                     $control++;
        }

                      


        }

}

    if($control == $count){

   return response()->json([
                'Mensagem' => 'Pedido Cadastrado com sucesso'
            ], 200);


    } 



     }


      public function atualizarPedido(Request $request, $id){

      $pedido = $this->validate($request, [

        'nome' =>  'required', 
        'descricao'  => 'required',
        'estoque' => 'required|integer',
        'preco' => 'required|numeric'

    ]);

       $dados = Pedido::Find($id);
       $dados->update($pedido);



        return response()->json(['mensagem'=>'Atualizado com sucesso!'],200);


     }


public function  selecionarTodos(){

       

    $dados = Pedido::algo();
     return response()->json($dados);

}

public function  selecionarTodos2(){

       

   $dados = Pedido::teste_eloquente();

   // $dados2 = $this->pedido->algo();
     return response()->json($dados);

}


     public function  selecionarPedido($id){

       

   
     $dados = Pedido::Find($id);
    

     return response()->json($dados);
     }

      public function excluirPedido ($id){

      

       $dados = Pedido::Find($id);
  

     $deletado=$dados->destroy($id);

    if($deletado){
        return response()->json(['mensagem'=>'Excluido com sucesso!'],200);



}else{



   return response()->json(['mensagem'=>'Falha ao Excluir!'],400);
}

     }


}
