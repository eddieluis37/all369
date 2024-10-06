<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRstApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rst_applicants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('replacement_staff_id');
            $table->integer('psycholabor_evaluation_score')->nullable();
            $table->integer('technical_evaluation_score')->nullable();
            $table->longText('observations')->nullable();
            //Exclusive Selected
            $table->boolean('selected')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('name_to_replace')->nullable();
            $table->string('replacement_reason')->nullable();
            $table->foreignId('ou_of_performance_id')->nullable();
            $table->foreignId('technical_evaluation_id');

            $table->foreign('replacement_staff_id')->references('id')->on('rst_replacement_staff');
            $table->foreign('technical_evaluation_id')->references('id')->on('rst_technical_evaluations');
            $table->foreign('ou_of_performance_id')->references('id')->on('organizational_units');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rst_applicants');
    }
}
