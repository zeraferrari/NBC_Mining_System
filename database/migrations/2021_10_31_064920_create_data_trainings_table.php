<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100);
            $table->enum('Gender', ['Laki-laki','Perempuan']);
            $table->unsignedFloat('Hemoglobin', 8, 1);
            $table->unsignedSmallInteger('Pressure_Sistole');
            $table->unsignedSmallInteger('Pressure_diastole');
            $table->unsignedSmallInteger('Weight');
            $table->enum('Status', ['Layak','Tidak Layak']);
            $table->foreignId('Rhesus_id')->constrained('rhesus_categories');
            $table->unsignedSmallInteger('Age');
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
        Schema::dropIfExists('data_trainings');
    }
}
