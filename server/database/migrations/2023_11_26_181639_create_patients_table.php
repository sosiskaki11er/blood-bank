<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->uuid('guid');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('blood_rh')->nullable();
            $table->string('blood_disease')->nullable();
            $table->string('blood_status')->nullable();
            $table->uuid('doctor_guid')->nullable();
            $table->date('birth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
