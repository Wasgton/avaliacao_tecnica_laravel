<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('client_id');
            $table->string('phone',11);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_phones');
    }
}
