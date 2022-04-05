<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTestingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_testings', function (Blueprint $table) {
            $table->id();
            $table->string('Name', 100);
            $table->enum('Gender', ['Laki-laki', 'Perempuan']);
            $table->unsignedFloat('Hemoglobin', 8, 1);
            $table->unsignedSmallInteger('Pressure_Sistole');
            $table->unsignedSmallInteger('Pressure_diastole');
            $table->unsignedSmallInteger('Weight');
            $table->unsignedSmallInteger('Age');
            $table->enum('Status', ['Layak','Tidak Layak']);
            $table->string('Result_Classification', 20);
            $table->foreignId('Rhesus_id')->constrained('rhesus_categories');
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
        Schema::dropIfExists('data_testings');
    }
}
