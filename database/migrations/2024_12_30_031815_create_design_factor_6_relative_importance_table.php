<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor6RelativeImportanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_factor_6_relative_importance', function (Blueprint $table) {
            $table->id('id_df6_ri'); // Primary key
            $table->unsignedBigInteger('df6_id'); // Foreign key to the design_factor_6 table
            $table->unsignedBigInteger('id'); // Foreign key to the users table

            // Manually specifying each column for relative importance
            $table->float('r_df6_1')->nullable();
            $table->float('r_df6_2')->nullable();
            $table->float('r_df6_3')->nullable();
            $table->float('r_df6_4')->nullable();
            $table->float('r_df6_5')->nullable();
            $table->float('r_df6_6')->nullable();
            $table->float('r_df6_7')->nullable();
            $table->float('r_df6_8')->nullable();
            $table->float('r_df6_9')->nullable();
            $table->float('r_df6_10')->nullable();
            $table->float('r_df6_11')->nullable();
            $table->float('r_df6_12')->nullable();
            $table->float('r_df6_13')->nullable();
            $table->float('r_df6_14')->nullable();
            $table->float('r_df6_15')->nullable();
            $table->float('r_df6_16')->nullable();
            $table->float('r_df6_17')->nullable();
            $table->float('r_df6_18')->nullable();
            $table->float('r_df6_19')->nullable();
            $table->float('r_df6_20')->nullable();
            $table->float('r_df6_21')->nullable();
            $table->float('r_df6_22')->nullable();
            $table->float('r_df6_23')->nullable();
            $table->float('r_df6_24')->nullable();
            $table->float('r_df6_25')->nullable();
            $table->float('r_df6_26')->nullable();
            $table->float('r_df6_27')->nullable();
            $table->float('r_df6_28')->nullable();
            $table->float('r_df6_29')->nullable();
            $table->float('r_df6_30')->nullable();
            $table->float('r_df6_31')->nullable();
            $table->float('r_df6_32')->nullable();
            $table->float('r_df6_33')->nullable();
            $table->float('r_df6_34')->nullable();
            $table->float('r_df6_35')->nullable();
            $table->float('r_df6_36')->nullable();
            $table->float('r_df6_37')->nullable();
            $table->float('r_df6_38')->nullable();
            $table->float('r_df6_39')->nullable();
            $table->float('r_df6_40')->nullable();

            $table->timestamps(); // Laravel's created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('df6_id')->references('df6_id')->on('design_factor_6')->onDelete('cascade');
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
        Schema::dropIfExists('design_factor_6_relative_importance');
    }
}
