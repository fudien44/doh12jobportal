<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('extension')->nullable();
            $table->date('dob')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('sex')->nullable();
            $table->string('religion',20)->nullable();
            $table->string('ethnicity',100)->nullable();
            $table->integer('civilstat')->nullable();
            $table->string('address')->nullable();
            $table->string('course')->nullable();
            $table->string('school')->nullable();
            $table->boolean('is_pwd')->nullable();
            $table->string('pwd_no')->nullable();
            $table->boolean('is_solpar')->nullable();
            $table->string('soloparent_no')->nullable();
            $table->string('highest_education',100)->nullable();
            $table->string('eligibility',100)->nullable();
            $table->mediumText('work_experience')->nullable();
            $table->mediumText('training')->nullable();
            $table->string('pds_file',50)->nullable();
            $table->string('tor_file',50)->nullable();
            $table->string('eligibility_file',50)->nullable();
            $table->string('other_document_file',50)->nullable();
            $table->string('picture_link',50)->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
