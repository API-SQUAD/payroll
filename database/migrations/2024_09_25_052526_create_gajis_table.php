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
        DB::statement('SET search_path TO payroll');

        Schema::create('gaji_details', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_gaji');
            $table->string('id_karyawan');
            $table->bigInteger('gaji_pokok');
            $table->bigInteger('tunjangan_tetap');
            $table->bigInteger('hari_kerja');
            $table->bigInteger('lembur');
            $table->bigInteger('bpjs_4');
            $table->bigInteger('bpjs_1');
            $table->bigInteger('jpn_2');
            $table->bigInteger('jpn_1');
            $table->timestamps();

            $table->foreign('id_karyawan')->references('id')->on('public.user')->cascadeOnDelete();
            $table->foreign('id_gaji')->references('id')->on('payroll.gajis')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll.gaji_details');
    }
};
