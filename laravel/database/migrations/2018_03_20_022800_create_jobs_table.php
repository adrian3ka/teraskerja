<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('jobTitle');
			$table->integer('fee');
			//$table->integer('id_user')->unsigned();
			$table->uuid('id_user');
            $table->timestamps();
        });
		
		//Set FK di table job
		Schema::table('jobs',function(Blueprint $table){
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
		//Drop record di job yang memiliki FK di kolom id_user tertentu jika record user di drop
		//misalnya job yang memiliki FK id_user = 1 ada 10
		//terus user yang memiliki id 1 , hapus akun, maka 10 job akan di drop
		//di table user
		Schema::table('jobs',function (Blueprint $table){
			$table->dropForeign('jobs_id_user_foreign');
		});
		
        Schema::dropIfExists('jobs');
    }
}
