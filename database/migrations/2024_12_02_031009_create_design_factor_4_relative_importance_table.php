<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor4RelativeImportanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_4_relative_importance', function (Blueprint $table) {
            $table->id('id_df4_ri'); // Primary key
            $table->unsignedBigInteger('df4_id'); // Foreign key to the design_factor_4 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Manually specifying each column for relative importance
            $table->float('r_df4_1')->nullable();
            $table->float('r_df4_2')->nullable();
            $table->float('r_df4_3')->nullable();
            $table->float('r_df4_4')->nullable();
            $table->float('r_df4_5')->nullable();
            $table->float('r_df4_6')->nullable();
            $table->float('r_df4_7')->nullable();
            $table->float('r_df4_8')->nullable();
            $table->float('r_df4_9')->nullable();
            $table->float('r_df4_10')->nullable();
            $table->float('r_df4_11')->nullable();
            $table->float('r_df4_12')->nullable();
            $table->float('r_df4_13')->nullable();
            $table->float('r_df4_14')->nullable();
            $table->float('r_df4_15')->nullable();
            $table->float('r_df4_16')->nullable();
            $table->float('r_df4_17')->nullable();
            $table->float('r_df4_18')->nullable();
            $table->float('r_df4_19')->nullable();
            $table->float('r_df4_20')->nullable();
            $table->float('r_df4_21')->nullable();
            $table->float('r_df4_22')->nullable();
            $table->float('r_df4_23')->nullable();
            $table->float('r_df4_24')->nullable();
            $table->float('r_df4_25')->nullable();
            $table->float('r_df4_26')->nullable();
            $table->float('r_df4_27')->nullable();
            $table->float('r_df4_28')->nullable();
            $table->float('r_df4_29')->nullable();
            $table->float('r_df4_30')->nullable();
            $table->float('r_df4_31')->nullable();
            $table->float('r_df4_32')->nullable();
            $table->float('r_df4_33')->nullable();
            $table->float('r_df4_34')->nullable();
            $table->float('r_df4_35')->nullable();
            $table->float('r_df4_36')->nullable();
            $table->float('r_df4_37')->nullable();
            $table->float('r_df4_38')->nullable();
            $table->float('r_df4_39')->nullable();
            $table->float('r_df4_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('df4_id')->references('df4_id')->on('design_factor_4')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_4_relative_importance');
    }
}
