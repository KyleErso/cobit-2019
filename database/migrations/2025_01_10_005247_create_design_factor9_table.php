<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor9Table extends Migration
{
    public function up()
    {
        Schema::create('design_factor_9', function (Blueprint $table) {
            $table->id('df9_id'); // Primary key untuk tabel design_factor_9
            $table->unsignedBigInteger('id'); // Foreign key ke tabel users
            $table->unsignedBigInteger('df_id'); // Kolom tambahan (jika diperlukan)
            $table->float('input1df9'); // Input 1 untuk df9
            $table->float('input2df9'); // Input 2 untuk df9
            $table->float('input3df9'); // Input 3 untuk df9
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_9'); // Menghapus tabel jika migrasi di-rollback
    }
}