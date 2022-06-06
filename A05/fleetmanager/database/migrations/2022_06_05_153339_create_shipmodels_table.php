<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipmodels', function (Blueprint $table) {
            $table->id();

            //Foreign Key für Hersteller
            $table->integer('manufacturer_id')->unsigned()->index();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');

            $table->string('name')->nullable();
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
        Schema::dropIfExists('shipmodels');
    }
}
