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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->string('activity');
            $table->text('description')->nullable();

            // Siapa yang membuat / mencatat aktivitas ini
            $table->unsignedBigInteger('created_by');

            // Opsi: Pegawai mana yang terkait dengan aktivitas ini
            $table->unsignedBigInteger('employee_id')->nullable();

            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
