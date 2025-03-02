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
        Schema::create('atasan_bawahan', function (Blueprint $table) {
            $table->id();
            $table->string('activity_id');
            $table->string('master_approver_id');
            $table->string('nip_atasan');
            $table->string('nama_atasan');
            $table->string('nama');
            $table->string('nip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atasan_bawahan');
    }
};
