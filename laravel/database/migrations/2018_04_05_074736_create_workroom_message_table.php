<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkroomMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workroom_messages', function (Blueprint $table) {
            $table->integer('id_accepted_job')->unsigned();
			$table->bigInteger('sequence_number')->unsigned();
			//$table->integer('id_user')->unsigned();
			$table->uuid('id_user');
			$table->text('message');
            $table->timestamps();
			
			//SET PK
			$table->primary(['id_accepted_job','sequence_number']);
			
			//Set FK job_milestones
			$table->foreign('id_accepted_job')
				  ->references('id')
				  ->on('accepted_jobs')
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
				  
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
		Schema::table('jobs',function (Blueprint $table){
			$table->dropForeign('workroom_messages_id_accepted_job_foreign');
		});
		
        Schema::dropIfExists('workroom_messages');
    }
}
