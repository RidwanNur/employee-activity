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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            // Relasi opsional ke tabel users, jika pegawai ini punya akun
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->string('nip')->unique();
            $table->string('name');
            $table->string('address');

            // Relasi ke tabel work_regions
            $table->unsignedBigInteger('region_id')->nullable();

            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null'); 
                  // set null jika user dihapus, agar data pegawai tetap ada

            $table->foreign('region_id')
                  ->references('id')
                  ->on('work_regions')
                  ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
