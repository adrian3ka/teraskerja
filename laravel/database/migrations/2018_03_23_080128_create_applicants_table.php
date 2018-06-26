<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
			//$table->integer('id_user')->unsigned()->index();
            $table->uuid('id_user')->index();
			$table->integer('id_job')->unsigned()->index();
            $table->timestamps();
			
			//SET PK
			$table->primary(['id_user','id_job']);
            
			
			//Set FK job_applicant --- jobs
			$table->foreign('id_job')
				  ->references('id')
				  ->on('jobs')
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
				  
			//Set FK job_applicant --- jobs
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
        Schema::dropIfExists('applicants');
    }
}
