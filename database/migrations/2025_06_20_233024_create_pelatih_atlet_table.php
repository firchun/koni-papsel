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
        Schema::create('pelatih_atlet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelatih')
                ->constrained('pelatih')
                ->onDelete('cascade');
            $table->foreignId('id_atlet')
                ->constrained('atlet')
                ->onDelete('cascade');
            $table->foreignId('id_kabupaten')
                ->constrained('kabupaten')
                ->onDelete('cascade');
            $table->foreignId('id_cabor')
                ->constrained('cabor')
                ->onDelete('cascade');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
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
        Schema::dropIfExists('pelatih_atlet');
    }
};
