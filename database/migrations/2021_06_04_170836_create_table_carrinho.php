<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCarrinho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('carrinhos', function (Blueprint $table) {
            
                        $table->increments('id');
                        $table->string('id_pedido');
                        $table->string('id_produto');
                        $table->float('quantidade');
                      //  $table->float('valor');
                      
                        //$table->boolean('verificado');
     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrinhos');
    }
}
