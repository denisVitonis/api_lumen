<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Pedido extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

protected $connection = 'mysql';
protected $table = 'pedidos';
protected $primaryKey='id';

    protected $fillable = [
       'id', 'data_compra', 'nome_comprador', 'valor_frete', 'status' 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function teste_eloquente(){


        return $this->hasMany('App\Carrinho','id_pedido');
    }



 public function getJWTIdentifier(){

        return $this->getKey();

    }

        public function getJWTCustomClaims(){

        return [];

    }



public function teste()
    {
       //$data= DB::table('pedidos')->join('carrinhos', 'pedidos.id', '=', 'carrinhos.id_pedido')
    
   // ->select('users.*', 'contacts.phone', 'orders.price')
  //  ->get();



                return $this->hasMany('App\Models\Carrinho');

  //  return $data;
    }

}
