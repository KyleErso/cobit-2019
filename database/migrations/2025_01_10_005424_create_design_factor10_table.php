<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor10Table extends Migration
{
    public function up()
    {
        Schema::create('design_factor_10', function (Blueprint $table) {
            $table->id('df10_id'); // Primary key untuk tabel design_factor_10
            $table->unsignedBigInteger('id'); // Foreign key ke tabel users
            $table->unsignedBigInteger('df_id'); // Kolom tambahan (jika diperlukan)
            $table->float('input1df10'); // Input 1 untuk df10
            $table->float('input2df10'); // Input 2 untuk df10
            $table->float('input3df10'); // Input 3 untuk df10
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_10'); // Menghapus tabel jika migrasi di-rollback
    }
}