<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_details', function (Blueprint $table) {
            $table->uuid('id');
			$table->bigInteger('sequence_number')->unsigned();
			$table->uuid('id_user');
			$table->text('message');
			$table->boolean('isRead')->default(0);
            $table->timestamps();
			
			//SET PK
			$table->primary(['id','sequence_number']);
			
			$table->foreign('id_user')
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
        Schema::dropIfExists('conversation_details');
    }
}
