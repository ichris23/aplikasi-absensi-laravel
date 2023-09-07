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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->string('karyawan_nik');
            $table->date('tgl_presensi');
            $table->time('jam_in');
            $table->time('jam_out');
            $table->string('foto_in');
            $table->string('foto_out');
            $table->text('location');
            $table->timestamps();

            //define foreign key constraint
            $table->foreign('karyawan_nik')->references('nik')->on('karyawans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
