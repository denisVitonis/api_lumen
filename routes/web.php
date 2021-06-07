<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/teste', function () use ($router) {
    return '[routes/web.php] Metodo GET URL: /teste';
});


// $router->get('/produtos', 'ProdutoController@listarProduto');


  /**
     *Grupo de rotas Produtos
   */
$router->group(['prefix' => 'produtos'], function () use ($router) {


$router->get('/{id}', 'ProdutoController@selecionarProduto'); 

$router->post('/cadastrar', 'ProdutoController@cadastrarProduto'); 

$router->put('/{id}/atualizar', 'ProdutoController@atualizarProduto'); 

$router->delete('/{id}/excluir', 'ProdutoController@excluirProduto');


});

Route::get('/selecionarTodos2', function () {

$pedido =App\Pedido::all();

dd($pedido->teste_eloquente);



});


$router->group(['prefix' => 'pedidos'], function () use ($router) {


 
$router->get('/todosPedidos', 'PedidoController@selecionarTodos');
$router->post('/cadastrar', 'PedidoController@cadastrarPedido'); 



});

  /**
     *Grupo de rotas Usuarios
   */
$router->group(['prefix' => 'usuarios'], function () use ($router) {


$router->get('/{id}', 'UsuarioController@selecionarUsuario'); 

$router->post('/cadastrar', 'UsuarioController@cadastrarUsuario'); 

$router->put('/{id}/atualizar', 'UsuarioController@atualizarUsuario'); 

$router->post('/login', 'UsuarioController@usuarioLogin');

$router->post('/autenticacao', 'UsuarioController@usuarioAutenticado');

$router->post('/logout', 'UsuarioController@usuarioLogout');
});


//$router->get('/usuarios', 'UsuarioController@mostrarTodosUsuarios'); 
//$router->get('/login', 'UsuarioController@usuarioLogin'); 
