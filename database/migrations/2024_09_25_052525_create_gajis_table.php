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

        Schema::create('gajis', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('periode');
            $table->dateTime('waktu_proses');
            $table->string('nama_user');
            $table->bigInteger('total_thp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};
