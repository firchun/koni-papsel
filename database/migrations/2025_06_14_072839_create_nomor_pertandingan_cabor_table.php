<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomor_pertandingan_cabor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cabor')->constrained('cabor')->onDelete('cascade');
            $table->string('nomor_pertandingan');
            $table->json('sub_nomor_pertandingan')->nullable();
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
        Schema::dropIfExists('nomor_pertandingan_cabor');
    }
};