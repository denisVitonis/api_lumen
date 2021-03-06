<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
     Schema::create('pedidos', function (Blueprint $table) {
            
                        $table->increments('id');
                        $table->string('nome_comprador');
                        $table->date('data_compra');
                        $table->float('valor_frete');
                        $table->string('status');
                      
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
        Schema::dropIfExists('pedidos');
    }
}
