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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('horaire_dep');
            $table->string('horaire_arr');
            $table->double('distance');
            $table->string('adress');
            $table->string('lieu');
            $table->string('numero_bus');
            $table->string('point1')->nullable();
            $table->string('point2')->nullable();
            $table->string('point3')->nullable();
            $table->string('point4')->nullable();
            $table->string('point5')->nullable();
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id')
            ->references('id')
            ->on('stations')
            ->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
