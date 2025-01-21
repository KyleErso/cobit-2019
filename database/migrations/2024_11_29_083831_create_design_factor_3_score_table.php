<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor3ScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_3_score', function (Blueprint $table) {
            $table->id('id_df3_sc'); // Primary key
            $table->unsignedBigInteger('df3_id'); // Foreign key to the design_factor_3 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Kolom skor untuk Design Factor 3 (manual tanpa for loop)
            $table->float('s_df3_1')->nullable();
            $table->float('s_df3_2')->nullable();
            $table->float('s_df3_3')->nullable();
            $table->float('s_df3_4')->nullable();
            $table->float('s_df3_5')->nullable();
            $table->float('s_df3_6')->nullable();
            $table->float('s_df3_7')->nullable();
            $table->float('s_df3_8')->nullable();
            $table->float('s_df3_9')->nullable();
            $table->float('s_df3_10')->nullable();
            $table->float('s_df3_11')->nullable();
            $table->float('s_df3_12')->nullable();
            $table->float('s_df3_13')->nullable();
            $table->float('s_df3_14')->nullable();
            $table->float('s_df3_15')->nullable();
            $table->float('s_df3_16')->nullable();
            $table->float('s_df3_17')->nullable();
            $table->float('s_df3_18')->nullable();
            $table->float('s_df3_19')->nullable();
            $table->float('s_df3_20')->nullable();
            $table->float('s_df3_21')->nullable();
            $table->float('s_df3_22')->nullable();
            $table->float('s_df3_23')->nullable();
            $table->float('s_df3_24')->nullable();
            $table->float('s_df3_25')->nullable();
            $table->float('s_df3_26')->nullable();
            $table->float('s_df3_27')->nullable();
            $table->float('s_df3_28')->nullable();
            $table->float('s_df3_29')->nullable();
            $table->float('s_df3_30')->nullable();
            $table->float('s_df3_31')->nullable();
            $table->float('s_df3_32')->nullable();
            $table->float('s_df3_33')->nullable();
            $table->float('s_df3_34')->nullable();
            $table->float('s_df3_35')->nullable();
            $table->float('s_df3_36')->nullable();
            $table->float('s_df3_37')->nullable();
            $table->float('s_df3_38')->nullable();
            $table->float('s_df3_39')->nullable();
            $table->float('s_df3_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at

            // Foreign key constraints
            $table->foreign('df3_id')->references('df3_id')->on('design_factor_3_a')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_3_score');
    }
}
