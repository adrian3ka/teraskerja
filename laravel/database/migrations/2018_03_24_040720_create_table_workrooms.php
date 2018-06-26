<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWorkrooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('workrooms', function (Blueprint $table) {
			$table->increments('id');
			//$table->integer('id_user')->unsigned();
            $table->uuid('id_user');
			$table->integer('id_accepted_job')->unsigned();
            $table->timestamps();
			
            
			
			//Set FK job_workroom --- jobs
			$table->foreign('id_accepted_job')
				  ->references('id')
				  ->on('accepted_jobs')
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
				  
			//Set FK user_workrooms --- users
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
    }
}
