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
        Schema::create('master_approver', function (Blueprint $table) {
            $table->id();
            $table->string('employee_atasan_id');
            $table->string('nip_atasan');
            $table->string('nama_atasan');
            $table->string('position_atasan');
            $table->string('employee_id');
            $table->string('nama');
            $table->string('nip');
            $table->string('position');
            $table->integer('is_active')->default(1);
            $table->integer('is_deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_approver');
    }
};
