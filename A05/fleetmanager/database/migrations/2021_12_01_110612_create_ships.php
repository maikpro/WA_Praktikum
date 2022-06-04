<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('shiptype')->nullable();
            $table->float('width')->default(0.0);
            $table->float('length')->default(0.0);
            $table->integer('crew')->default(0); //Schiffsbesatzung
            $table->float('brt')->default(0.0); // BRT => (BruttoRegisterTonne - nutzbarer Rauminhalt eines Schiffes)
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
        Schema::dropIfExists('ships');
    }
}
