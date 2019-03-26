<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c94c2a0da9d0ClientProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('client_product')) {
            Schema::create('client_product', function (Blueprint $table) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', 'fk_p_281134_281138_produc_5c94c2a0dab50')->references('id')->on('clients')->onDelete('cascade');
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_281138_281134_client_5c94c2a0dac40')->references('id')->on('products')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_product');
    }
}
