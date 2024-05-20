<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('professional_id')->nullable();
            $table->text('patient_info');
            $table->dateTime('date_time');
            $table->integer('consecutive_number');
            $table->text('patient_status')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('final_evolution')->nullable();
            $table->text('professional_concept')->nullable();
            $table->text('recommendations')->nullable();
            $table->boolean('assistance')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            // Relación con la tabla de pacientes
            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('professional_id')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
