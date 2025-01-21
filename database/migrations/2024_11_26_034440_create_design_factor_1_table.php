<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_1', function (Blueprint $table) {
            $table->id('df1_id'); // Primary key
            $table->unsignedBigInteger('id'); // Foreign key ke tabel users
            $table->unsignedBigInteger('df_id'); // Foreign key ke tabel view atau tombol terkait
            $table->float('input1df1'); // Input 1 dengan tipe data float
            $table->float('input2df1'); // Input 2 dengan tipe data float
            $table->float('input3df1'); // Input 3 dengan tipe data float
            $table->float('input4df1'); // Input 4 dengan tipe data float
            $table->timestamps(); // Kolom created_at dan updated_at

            // Relasi foreign key
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design_factor_1');
    }
}
