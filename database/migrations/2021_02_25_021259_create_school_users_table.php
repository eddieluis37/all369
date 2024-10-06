<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_users_external', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->foreignId('user_external_id');
            $table->boolean('admin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('school_id')->references('id')->on('schools');
            $table->foreign('user_external_id')->references('id')->on('users_external');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_users_external');
    }
}
