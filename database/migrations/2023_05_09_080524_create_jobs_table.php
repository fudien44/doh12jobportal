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
            $table->bigIncrements('id');
            $table->integer('division_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('job_title');
            $table->string('area_ass');
            $table->string('job_description')->nullable();
            $table->integer('salary_grade')->nullable();
            $table->string('monthly_salary')->nullable();
            $table->string('item_no')->nullable();
            $table->string('eligibility')->nullable();
            $table->string('education')->nullable();
            $table->string('highest_education')->nullable();
            $table->string('training')->nullable();
            $table->string('experience')->nullable();
            $table->integer('type_job')->nullable();
            $table->integer('term_emp')->nullable();
            $table->mediumText('instruction')->nullable();
            $table->date('date_posted');
            $table->date('date_closed');
            $table->string('attach')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
