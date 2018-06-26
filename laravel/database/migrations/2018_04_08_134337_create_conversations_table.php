<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('id');
			$table->uuid('id_user1');
			$table->uuid('id_user2');
            $table->timestamps();
			
			$table->primary(['id']);
			
			$table->foreign('id_user1')
				  ->references('id')
				  ->on('users')
				  ->onDelete('no action')
				  ->onUpdate('cascade');
			
			$table->foreign('id_user2')
				  ->references('id')
				  ->on('users')
				  ->onDelete('no action')
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
        Schema::dropIfExists('conversations');
    }
}
