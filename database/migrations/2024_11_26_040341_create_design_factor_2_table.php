<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_2', function (Blueprint $table) {
            $table->id('df2_id'); // Primary key
            $table->unsignedBigInteger('id'); // Foreign key to users table
            $table->unsignedBigInteger('df_id'); // Foreign key to related view or button

            // Input columns for design factor 2
            $table->float('input1df2');
            $table->float('input2df2');
            $table->float('input3df2');
            $table->float('input4df2');
            $table->float('input5df2');
            $table->float('input6df2');
            $table->float('input7df2');
            $table->float('input8df2');
            $table->float('input9df2');
            $table->float('input10df2');
            $table->float('input11df2');
            $table->float('input12df2');
            $table->float('input13df2');

            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns

            // Foreign key constraints (if necessary, add foreign key constraints)
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
        Schema::dropIfExists('design_factor_2');
    }
}
