<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('CPF',11);
            $table->string('RG');
            $table->date('birth_date');
            $table->unsignedBigInteger('birth_place_id');
            $table->unsignedBigInteger('deleted_for');
            $table->unsignedBigInteger('updated_for');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('deleted_for')->references('id')->on('users');
            $table->foreign('updated_for')->references('id')->on('users');
            $table->foreign('birth_place_id')->references('id')->on('birth_places');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
