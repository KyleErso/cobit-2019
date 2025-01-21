\<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor7ScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_7_score', function (Blueprint $table) {
            $table->id('id_df7_sc'); // Primary key
            $table->unsignedBigInteger('df7_id'); // Foreign key to the design_factor_7 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Kolom skor untuk Design Factor 7 (manual tanpa for loop)
            $table->float('s_df7_1')->nullable();
            $table->float('s_df7_2')->nullable();
            $table->float('s_df7_3')->nullable();
            $table->float('s_df7_4')->nullable();
            $table->float('s_df7_5')->nullable();
            $table->float('s_df7_6')->nullable();
            $table->float('s_df7_7')->nullable();
            $table->float('s_df7_8')->nullable();
            $table->float('s_df7_9')->nullable();
            $table->float('s_df7_10')->nullable();
            $table->float('s_df7_11')->nullable();
            $table->float('s_df7_12')->nullable();
            $table->float('s_df7_13')->nullable();
            $table->float('s_df7_14')->nullable();
            $table->float('s_df7_15')->nullable();
            $table->float('s_df7_16')->nullable();
            $table->float('s_df7_17')->nullable();
            $table->float('s_df7_18')->nullable();
            $table->float('s_df7_19')->nullable();
            $table->float('s_df7_20')->nullable();
            $table->float('s_df7_21')->nullable();
            $table->float('s_df7_22')->nullable();
            $table->float('s_df7_23')->nullable();
            $table->float('s_df7_24')->nullable();
            $table->float('s_df7_25')->nullable();
            $table->float('s_df7_26')->nullable();
            $table->float('s_df7_27')->nullable();
            $table->float('s_df7_28')->nullable();
            $table->float('s_df7_29')->nullable();
            $table->float('s_df7_30')->nullable();
            $table->float('s_df7_31')->nullable();
            $table->float('s_df7_32')->nullable();
            $table->float('s_df7_33')->nullable();
            $table->float('s_df7_34')->nullable();
            $table->float('s_df7_35')->nullable();
            $table->float('s_df7_36')->nullable();
            $table->float('s_df7_37')->nullable();
            $table->float('s_df7_38')->nullable();
            $table->float('s_df7_39')->nullable();
            $table->float('s_df7_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at

            // Foreign key constraints
            $table->foreign('df7_id')->references('df7_id')->on('design_factor_7')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_7_score');
    }
}
