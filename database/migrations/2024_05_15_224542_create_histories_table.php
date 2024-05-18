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
            $table->string('patient_id')->nullable();
            $table->string('professional_id')->nullable();
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
            $table->foreign('patient_id')->references('identification_number')->on('users');
            $table->foreign('professional_id')->references('identification_number')->on('users');
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
