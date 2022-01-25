<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_donors', function (Blueprint $table) {
            $table->id();
            $table->string('Code_Transaction', 20)->nullable();
            $table->unsignedSmallInteger('Age')->nullable();
            $table->unsignedSmallInteger('Weight')->nullable();
            $table->unsignedFloat('Hemoglobin', 8, 1)->nullable();
            $table->unsignedSmallInteger('Pressure_sistole')->nullable();
            $table->unsignedSmallInteger('Pressure_diastole')->nullable();
            $table->date('Waktu_Donor')->nullable();
            $table->date('Kembali_Donor')->nullable();
            $table->enum('Status_Transaction', ['Layak', 'Tidak Layak'])->nullable();
            $table->enum('Status_Donor', ['Medical Check', 'Berhasil Mendonor', 'Gagal Donor']);
            $table->foreignId('User_Pendonor_id')->nullable()->constrained('users');
            $table->foreignId('User_PM_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('transaction_donors');
    }
}
