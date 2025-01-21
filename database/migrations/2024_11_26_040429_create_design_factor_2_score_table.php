<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor2ScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_2_score', function (Blueprint $table) {
            $table->id('id_df2_sc'); // Primary key
            $table->unsignedBigInteger('df2_id'); // Foreign key to the design_factor_2 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Score columns for design factor 2
            $table->float('s_df2_1')->nullable();
            $table->float('s_df2_2')->nullable();
            $table->float('s_df2_3')->nullable();
            $table->float('s_df2_4')->nullable();
            $table->float('s_df2_5')->nullable();
            $table->float('s_df2_6')->nullable();
            $table->float('s_df2_7')->nullable();
            $table->float('s_df2_8')->nullable();
            $table->float('s_df2_9')->nullable();
            $table->float('s_df2_10')->nullable();
            $table->float('s_df2_11')->nullable();
            $table->float('s_df2_12')->nullable();
            $table->float('s_df2_13')->nullable();
            $table->float('s_df2_14')->nullable();
            $table->float('s_df2_15')->nullable();
            $table->float('s_df2_16')->nullable();
            $table->float('s_df2_17')->nullable();
            $table->float('s_df2_18')->nullable();
            $table->float('s_df2_19')->nullable();
            $table->float('s_df2_20')->nullable();
            $table->float('s_df2_21')->nullable();
            $table->float('s_df2_22')->nullable();
            $table->float('s_df2_23')->nullable();
            $table->float('s_df2_24')->nullable();
            $table->float('s_df2_25')->nullable();
            $table->float('s_df2_26')->nullable();
            $table->float('s_df2_27')->nullable();
            $table->float('s_df2_28')->nullable();
            $table->float('s_df2_29')->nullable();
            $table->float('s_df2_30')->nullable();
            $table->float('s_df2_31')->nullable();
            $table->float('s_df2_32')->nullable();
            $table->float('s_df2_33')->nullable();
            $table->float('s_df2_34')->nullable();
            $table->float('s_df2_35')->nullable();
            $table->float('s_df2_36')->nullable();
            $table->float('s_df2_37')->nullable();
            $table->float('s_df2_38')->nullable();
            $table->float('s_df2_39')->nullable();
            $table->float('s_df2_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at

            // Foreign key constraints
            $table->foreign('df2_id')->references('df2_id')->on('design_factor_2')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_2_score');
    }
}
