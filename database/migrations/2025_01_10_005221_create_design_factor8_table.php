<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor8Table extends Migration
{
    public function up()
    {
        Schema::create('design_factor_8', function (Blueprint $table) {
            $table->id('df8_id'); // Primary key untuk tabel design_factor_8
            $table->unsignedBigInteger('id'); // Foreign key ke tabel users
            $table->unsignedBigInteger('df_id'); // Kolom tambahan (jika diperlukan)
            $table->float('input1df8'); // Input 1 untuk df8
            $table->float('input2df8'); // Input 2 untuk df8
            $table->float('input3df8'); // Input 3 untuk df8
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_8'); // Menghapus tabel jika migrasi di-rollback
    }
}