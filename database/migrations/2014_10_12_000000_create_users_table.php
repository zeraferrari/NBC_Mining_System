<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('NIK', 16)->unique();
            $table->enum('Gender', ['Laki-laki','Perempuan']);
            $table->string('phone_number', 13);
            $table->text('alamat');
            $table->string('profile_picture')->nullable();
            $table->enum('Status_Donor', ['Belum Mendonor', 'Sudah Mendonor']);
            $table->foreignId('Rhesus_id')->nullable()->constrained('rhesus_categories');
            $table->date('create_at')->nullable();
            $table->date('update_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
