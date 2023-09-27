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
        Schema::create('pengajuan_izin', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->date('tgl_izin');
            $table->char('status');
            $table->string('keterangan');
            $table->char('status_approved')->default(0);
            $table->timestamps();

            //define foreign key constraint
            $table->foreign('nik')->references('nik')->on('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_izin');
    }
};
