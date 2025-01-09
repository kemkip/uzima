<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_number')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birth_date')->nullable();
            $table->integer('age');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->date('entry_date')->default(Carbon::now());
            $table->unsignedBigInteger('patientcategory_id');
            $table->unsignedBigInteger('country_id')->nullable()->default(113);
            $table->unsignedBigInteger('diagnosis_id');
            $table->string('description')->nullable();

            $table->foreign('patientcategory_id')->references('id')->on('patientcategories')->onDelete('cascade');
            $table->foreign('diagnosis_id')->references('id')->on('diagnoses')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
