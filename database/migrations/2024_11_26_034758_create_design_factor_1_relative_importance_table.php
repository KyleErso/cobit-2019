<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor1RelativeImportanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_1_relative_importance', function (Blueprint $table) {
            $table->id('id_df1_ri'); // Primary key
            $table->unsignedBigInteger('df1_id'); // Foreign key to the design_factor_1 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Adding the relative importance columns manually
            $table->float('r_df1_1')->nullable();
            $table->float('r_df1_2')->nullable();
            $table->float('r_df1_3')->nullable();
            $table->float('r_df1_4')->nullable();
            $table->float('r_df1_5')->nullable();
            $table->float('r_df1_6')->nullable();
            $table->float('r_df1_7')->nullable();
            $table->float('r_df1_8')->nullable();
            $table->float('r_df1_9')->nullable();
            $table->float('r_df1_10')->nullable();
            $table->float('r_df1_11')->nullable();
            $table->float('r_df1_12')->nullable();
            $table->float('r_df1_13')->nullable();
            $table->float('r_df1_14')->nullable();
            $table->float('r_df1_15')->nullable();
            $table->float('r_df1_16')->nullable();
            $table->float('r_df1_17')->nullable();
            $table->float('r_df1_18')->nullable();
            $table->float('r_df1_19')->nullable();
            $table->float('r_df1_20')->nullable();
            $table->float('r_df1_21')->nullable();
            $table->float('r_df1_22')->nullable();
            $table->float('r_df1_23')->nullable();
            $table->float('r_df1_24')->nullable();
            $table->float('r_df1_25')->nullable();
            $table->float('r_df1_26')->nullable();
            $table->float('r_df1_27')->nullable();
            $table->float('r_df1_28')->nullable();
            $table->float('r_df1_29')->nullable();
            $table->float('r_df1_30')->nullable();
            $table->float('r_df1_31')->nullable();
            $table->float('r_df1_32')->nullable();
            $table->float('r_df1_33')->nullable();
            $table->float('r_df1_34')->nullable();
            $table->float('r_df1_35')->nullable();
            $table->float('r_df1_36')->nullable();
            $table->float('r_df1_37')->nullable();
            $table->float('r_df1_38')->nullable();
            $table->float('r_df1_39')->nullable();
            $table->float('r_df1_40')->nullable();

            $table->timestamps(); // Adding created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('df1_id')->references('df1_id')->on('design_factor_1')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_1_relative_importance');
    }
}
