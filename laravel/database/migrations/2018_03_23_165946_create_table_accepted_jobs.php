<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAcceptedJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('accepted_jobs', function (Blueprint $table) {
            $table->integer('id')->unsigned();
			$table->string('jobTitle');
			$table->integer('fee');
			//$table->integer('id_user')->unsigned();
			$table->uuid('id_user');
            $table->timestamps();
			
			
			$table->primary('id');
        });
		
		//Set FK di table job
		Schema::table('accepted_jobs',function(Blueprint $table){
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
		//Drop record di job yang memiliki FK di kolom id_user tertentu jika record user di drop
		//misalnya job yang memiliki FK id_user = 1 ada 10
		//terus user yang memiliki id 1 , hapus akun, maka 10 job akan di drop
		//di table user
		Schema::table('accepted_jobs',function (Blueprint $table){
			$table->dropForeign('accepted_jobs_id_user_foreign');
		});
    }
}
