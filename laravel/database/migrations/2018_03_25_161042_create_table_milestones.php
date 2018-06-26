<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMilestones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('milestones', function (Blueprint $table) {
        //
			$table->integer('id_accepted_job')->unsigned()->index();
			$table->integer('id_milestone')->unsigned()->index();
			$table->string('milestone_title');
			$table->text('milestone_description');
			$table->boolean('client_done')->default(0);
			$table->boolean('lancer_done')->default(0);
			$table->timestamps();
			
			//SET PK
			$table->primary(['id_accepted_job','id_milestone']);
			
			//Set FK job_milestones
			$table->foreign('id_accepted_job')
				  ->references('id')
				  ->on('accepted_jobs')
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
