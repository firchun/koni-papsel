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
        Schema::create('pelatih', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kabupaten')->constrained('kabupaten')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nik_kk')->unique();
            $table->string('nik_ktp')->unique();
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('pendidikan_terakhir');
            $table->string('cabang_olahraga');

            // Dokumen kelengkapan (bisa simpan file path-nya)
            $table->string('ijazah')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('ktp')->nullable();
            $table->string('akte_kelahiran')->nullable();
            $table->string('pas_photo')->nullable();
            $table->string('lisensi_pelatih')->nullable();

            // Verifikasi & status
            $table->boolean('is_verified')->default(0);
            $table->enum('status', ['Pengajuan', 'Revisi', 'Verified'])->default('pengajuan');
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
        Schema::dropIfExists('pelatih');
    }
};
