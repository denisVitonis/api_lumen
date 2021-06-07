<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api', [
                    'except' => ['usuarioLogin', 'cadastrarUsuario']
        ]);

       // var_dump($jwt);
    }


 



    public function usuarioLogin(Request $request){

        $this->validate($request, [
            'email' => 'required|email|max:255', 
            'password' => 'required',
        ]);

        if(! $token = $this->jwt->claims(['email' => $request->email])->attempt($request->only('email', 'password')))
        {
            return response()->json(['Usuario nao encontrado'],404);
        }

        return response()->json(compact('token'));

    }

     public function mostrarTodosUsuarios(){


        return response()->json(Usuario::all());


     }


       public function cadastrarUsuario(Request $request){

            $this->validate($request, [

        'usuario' =>  'required|min:8|max:40', 
        'email'  => 'required|email|unique:usuarios,email',
        'cnpj' => 'required|integer|min:14',
        'password' => 'required'

        ]);

      //encriptando o password
      $usuario = new Usuario;
      $usuario->email = $request->email;
      $usuario->usuario = $request->usuario;
      $usuario->cnpj = $request->cnpj;
      $usuario->password = Hash::make($request->password);

      $criado = $usuario->save();

     
     // $criado = Usuario::create($usuario);


       if($criado){

        return response()->json(['mensagem'=>'Cadastrado com sucesso!'],200);

       }else{

         return response()->json(['mensagem'=>'Falha ao cadastrar!'],400);
       }
       


     }


      public function atualizarUsuario(Request $request, $id){

      $usuario = $this->validate($request, [

        'email'  => 'required|email|unique:usuarios,email',
        'cnpj' => 'required|integer|min:14',
        'password' => 'required'

    ]);
     



       $dados = Usuario::Find($id);
       $dados->update($produto);



        return response()->json(['mensagem'=>'Atualizado com sucesso!'],200);

 
     }

        public function usuarioAutenticado(){

            $usuario = Auth::user();

            return response()->json($usuario);

        }

        public function usuarioLogout(){

            Auth::logout();

            return response()->json("Usuário deslogado com sucesso");
        }


 }

 //hash api sensivel ao cors