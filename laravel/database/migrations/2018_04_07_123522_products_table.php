<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
			//$table->integer('id_user')->unsigned();
			$table->uuid('id_user');
			$table->string('product_name');
			$table->bigInteger('price')->unsigned();
            $table->timestamps();
			
			//SET PK
			$table->primary(['id','id_user']);
			
			
			$table->foreign('id_user')
				  ->references('id')
				  ->on('users')
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::dropIfExists('products');
    }
}
