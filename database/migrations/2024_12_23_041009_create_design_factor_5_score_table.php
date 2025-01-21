<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor5ScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_5_score', function (Blueprint $table) {
            $table->id('id_df5_sc'); // Primary key
            $table->unsignedBigInteger('df5_id'); // Foreign key to the design_factor_5 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Kolom skor untuk Design Factor 5 (manual tanpa for loop)
            $table->float('s_df5_1')->nullable();
            $table->float('s_df5_2')->nullable();
            $table->float('s_df5_3')->nullable();
            $table->float('s_df5_4')->nullable();
            $table->float('s_df5_5')->nullable();
            $table->float('s_df5_6')->nullable();
            $table->float('s_df5_7')->nullable();
            $table->float('s_df5_8')->nullable();
            $table->float('s_df5_9')->nullable();
            $table->float('s_df5_10')->nullable();
            $table->float('s_df5_11')->nullable();
            $table->float('s_df5_12')->nullable();
            $table->float('s_df5_13')->nullable();
            $table->float('s_df5_14')->nullable();
            $table->float('s_df5_15')->nullable();
            $table->float('s_df5_16')->nullable();
            $table->float('s_df5_17')->nullable();
            $table->float('s_df5_18')->nullable();
            $table->float('s_df5_19')->nullable();
            $table->float('s_df5_20')->nullable();
            $table->float('s_df5_21')->nullable();
            $table->float('s_df5_22')->nullable();
            $table->float('s_df5_23')->nullable();
            $table->float('s_df5_24')->nullable();
            $table->float('s_df5_25')->nullable();
            $table->float('s_df5_26')->nullable();
            $table->float('s_df5_27')->nullable();
            $table->float('s_df5_28')->nullable();
            $table->float('s_df5_29')->nullable();
            $table->float('s_df5_30')->nullable();
            $table->float('s_df5_31')->nullable();
            $table->float('s_df5_32')->nullable();
            $table->float('s_df5_33')->nullable();
            $table->float('s_df5_34')->nullable();
            $table->float('s_df5_35')->nullable();
            $table->float('s_df5_36')->nullable();
            $table->float('s_df5_37')->nullable();
            $table->float('s_df5_38')->nullable();
            $table->float('s_df5_39')->nullable();
            $table->float('s_df5_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at

            // Foreign key constraints
            $table->foreign('df5_id')->references('df5_id')->on('design_factor_5')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_5_score');
    }
}
