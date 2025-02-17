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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('hrn');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->date('dob');
            $table->string('civilstatus');
            $table->string('sex');
            $table->integer('contact');
            $table->string('street');
            $table->string('citymun');
            $table->string('barangay');
            $table->string('district');
            $table->integer('zipcode');
            $table->string('image')->nullable();
            $table->string('status')->default('Active');
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
