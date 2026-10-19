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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->increments('pelanggan_id'); // Berfungsi untuk membuat kolom pelanggan_id sebagai primary key yang akan bertambah otomatis (auto increment) setiap kali data baru ditambahkan.
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('birthday')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('email')->unique();
            $table->string('phone', 20)->nullable();
            $table->timestamps(); // Secara otomatis menambahkan dua kolom, yaitu created_at dan updated_at, yang digunakan untuk mencatat waktu pembuatan dan pembaruan data.Pastikan selalu ada setiap membuat table baru!
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
