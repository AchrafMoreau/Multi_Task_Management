<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->date('start_date');
            $table->date('end_date');
            $table->string("type");
            $table->string("agent"); 
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('depart_ville')->nullable();
            $table->unsignedBigInteger('destination_ville')->nullable();
            $table->foreign('destination_ville')->references('id')->on('villes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('depart_ville')->references('id')->on('villes')->onDelete('cascade')->onUpdate('cascade');
            $table->string("des_coll_terr")->nullable();
            $table->string("dep_coll_terr")->nullable();
            $table->string('permission');
            $table->integer("avance")->nullable();
            $table->integer("reste")->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
