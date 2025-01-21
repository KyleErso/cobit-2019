<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor8ScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_8_score', function (Blueprint $table) {
            $table->id('id_df8_sc'); // Primary key
            $table->unsignedBigInteger('df8_id'); // Foreign key to the design_factor_8 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Kolom skor untuk Design Factor 8 (manual tanpa for loop)
            $table->float('s_df8_1')->nullable();
            $table->float('s_df8_2')->nullable();
            $table->float('s_df8_3')->nullable();
            $table->float('s_df8_4')->nullable();
            $table->float('s_df8_5')->nullable();
            $table->float('s_df8_6')->nullable();
            $table->float('s_df8_7')->nullable();
            $table->float('s_df8_8')->nullable();
            $table->float('s_df8_9')->nullable();
            $table->float('s_df8_10')->nullable();
            $table->float('s_df8_11')->nullable();
            $table->float('s_df8_12')->nullable();
            $table->float('s_df8_13')->nullable();
            $table->float('s_df8_14')->nullable();
            $table->float('s_df8_15')->nullable();
            $table->float('s_df8_16')->nullable();
            $table->float('s_df8_17')->nullable();
            $table->float('s_df8_18')->nullable();
            $table->float('s_df8_19')->nullable();
            $table->float('s_df8_20')->nullable();
            $table->float('s_df8_21')->nullable();
            $table->float('s_df8_22')->nullable();
            $table->float('s_df8_23')->nullable();
            $table->float('s_df8_24')->nullable();
            $table->float('s_df8_25')->nullable();
            $table->float('s_df8_26')->nullable();
            $table->float('s_df8_27')->nullable();
            $table->float('s_df8_28')->nullable();
            $table->float('s_df8_29')->nullable();
            $table->float('s_df8_30')->nullable();
            $table->float('s_df8_31')->nullable();
            $table->float('s_df8_32')->nullable();
            $table->float('s_df8_33')->nullable();
            $table->float('s_df8_34')->nullable();
            $table->float('s_df8_35')->nullable();
            $table->float('s_df8_36')->nullable();
            $table->float('s_df8_37')->nullable();
            $table->float('s_df8_38')->nullable();
            $table->float('s_df8_39')->nullable();
            $table->float('s_df8_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at

            // Foreign key constraints
            $table->foreign('df8_id')->references('df8_id')->on('design_factor_8')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_8_score');
    }
}