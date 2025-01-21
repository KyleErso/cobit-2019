<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor9ScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_9_score', function (Blueprint $table) {
            $table->id('id_df9_sc'); // Primary key
            $table->unsignedBigInteger('df9_id'); // Foreign key to the design_factor_9 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Kolom skor untuk Design Factor 9 (manual tanpa for loop)
            $table->float('s_df9_1')->nullable();
            $table->float('s_df9_2')->nullable();
            $table->float('s_df9_3')->nullable();
            $table->float('s_df9_4')->nullable();
            $table->float('s_df9_5')->nullable();
            $table->float('s_df9_6')->nullable();
            $table->float('s_df9_7')->nullable();
            $table->float('s_df9_8')->nullable();
            $table->float('s_df9_9')->nullable();
            $table->float('s_df9_10')->nullable();
            $table->float('s_df9_11')->nullable();
            $table->float('s_df9_12')->nullable();
            $table->float('s_df9_13')->nullable();
            $table->float('s_df9_14')->nullable();
            $table->float('s_df9_15')->nullable();
            $table->float('s_df9_16')->nullable();
            $table->float('s_df9_17')->nullable();
            $table->float('s_df9_18')->nullable();
            $table->float('s_df9_19')->nullable();
            $table->float('s_df9_20')->nullable();
            $table->float('s_df9_21')->nullable();
            $table->float('s_df9_22')->nullable();
            $table->float('s_df9_23')->nullable();
            $table->float('s_df9_24')->nullable();
            $table->float('s_df9_25')->nullable();
            $table->float('s_df9_26')->nullable();
            $table->float('s_df9_27')->nullable();
            $table->float('s_df9_28')->nullable();
            $table->float('s_df9_29')->nullable();
            $table->float('s_df9_30')->nullable();
            $table->float('s_df9_31')->nullable();
            $table->float('s_df9_32')->nullable();
            $table->float('s_df9_33')->nullable();
            $table->float('s_df9_34')->nullable();
            $table->float('s_df9_35')->nullable();
            $table->float('s_df9_36')->nullable();
            $table->float('s_df9_37')->nullable();
            $table->float('s_df9_38')->nullable();
            $table->float('s_df9_39')->nullable();
            $table->float('s_df9_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at

            // Foreign key constraints
            $table->foreign('df9_id')->references('df9_id')->on('design_factor_9')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_9_score');
    }
}