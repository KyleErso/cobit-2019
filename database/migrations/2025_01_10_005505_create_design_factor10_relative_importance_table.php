<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor10RelativeImportanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_10_relative_importance', function (Blueprint $table) {
            $table->id('id_df10_ri'); // Primary key
            $table->unsignedBigInteger('df10_id'); // Foreign key to the design_factor_10 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Manually specifying each column for relative importance
            $table->float('r_df10_1')->nullable();
            $table->float('r_df10_2')->nullable();
            $table->float('r_df10_3')->nullable();
            $table->float('r_df10_4')->nullable();
            $table->float('r_df10_5')->nullable();
            $table->float('r_df10_6')->nullable();
            $table->float('r_df10_7')->nullable();
            $table->float('r_df10_8')->nullable();
            $table->float('r_df10_9')->nullable();
            $table->float('r_df10_10')->nullable();
            $table->float('r_df10_11')->nullable();
            $table->float('r_df10_12')->nullable();
            $table->float('r_df10_13')->nullable();
            $table->float('r_df10_14')->nullable();
            $table->float('r_df10_15')->nullable();
            $table->float('r_df10_16')->nullable();
            $table->float('r_df10_17')->nullable();
            $table->float('r_df10_18')->nullable();
            $table->float('r_df10_19')->nullable();
            $table->float('r_df10_20')->nullable();
            $table->float('r_df10_21')->nullable();
            $table->float('r_df10_22')->nullable();
            $table->float('r_df10_23')->nullable();
            $table->float('r_df10_24')->nullable();
            $table->float('r_df10_25')->nullable();
            $table->float('r_df10_26')->nullable();
            $table->float('r_df10_27')->nullable();
            $table->float('r_df10_28')->nullable();
            $table->float('r_df10_29')->nullable();
            $table->float('r_df10_30')->nullable();
            $table->float('r_df10_31')->nullable();
            $table->float('r_df10_32')->nullable();
            $table->float('r_df10_33')->nullable();
            $table->float('r_df10_34')->nullable();
            $table->float('r_df10_35')->nullable();
            $table->float('r_df10_36')->nullable();
            $table->float('r_df10_37')->nullable();
            $table->float('r_df10_38')->nullable();
            $table->float('r_df10_39')->nullable();
            $table->float('r_df10_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('df10_id')->references('df10_id')->on('design_factor_10')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_10_relative_importance');
    }
}