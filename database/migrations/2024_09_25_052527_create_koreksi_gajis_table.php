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

        Schema::create('koreksi_gajis', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_gaji_detail');
            $table->bigInteger('total');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('id_gaji_detail')->references('id')->on('gaji_details')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll.koreksi_gajis');
    }
};
