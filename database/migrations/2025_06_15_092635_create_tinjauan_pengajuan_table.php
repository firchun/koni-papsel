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
        Schema::create('tinjauan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_atlet')->constrained('atlet')
                ->nullable()
                ->onDelete('cascade');
            $table->text('isi');
            $table->enum('status', ['Diterima', 'Ditolak', 'Revisi'])
                ->default('Revisi');
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
        Schema::dropIfExists('tinjauan_pengajuan');
    }
};