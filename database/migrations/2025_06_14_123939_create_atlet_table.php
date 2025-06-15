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
        Schema::create('atlet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kabupaten')->constrained('kabupaten')
                ->onDelete('cascade');
            $table->foreignId('id_cabor')->constrained('cabor')
                ->onDelete('cascade');
            $table->foreignId('id_nomor_pertandingan_cabor')->constrained('nomor_pertandingan_cabor')
                ->onDelete('cascade');
            $table->string('sub_nomor_pertandingan');
            $table->string('nama_lengkap');
            $table->string('nik_kk');
            $table->string('nik_ktp')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('pendidikan_terakhir')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('fc_ijazah')->nullable();
            $table->string('fc_ktp')->nullable();
            $table->string('fc_kk')->nullable();
            $table->string('akta')->nullable();
            $table->string('pas_foto')->nullable();
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
        Schema::dropIfExists('atlet');
    }
};