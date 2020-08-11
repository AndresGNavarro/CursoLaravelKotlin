<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtyUserTable extends Migration
{
   //Esta migración representa la tabla que relaciona Users y Specialties, la manera de crearla en Laravel es nombrarla con ambas tablas en orden alfabético en este caso primero Specialty y después User.
    public function up()
    {
        Schema::create('specialty_user', function (Blueprint $table) {
            $table->id();

            //Doctor
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //Specialty
            $table->unsignedBigInteger('specialty_id');
            $table->foreign('specialty_id')->references('id')->on('specialties');

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
        Schema::dropIfExists('specialty_user');
    }
}
