<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor3BTable extends Migration
{
    public function up()
    {
        Schema::create('design_factor_3_b', function (Blueprint $table) {
            $table->id('df3b_id'); // Primary key
            $table->unsignedBigInteger('id'); // Foreign key to users table
            $table->unsignedBigInteger('df_id'); // Foreign key to related view or button

            // Impact fields
            $table->float('impact1');
            $table->float('impact2');
            $table->float('impact3');
            $table->float('impact4');
            $table->float('impact5');
            $table->float('impact6');
            $table->float('impact7');
            $table->float('impact8');
            $table->float('impact9');
            $table->float('impact10');
            $table->float('impact11');
            $table->float('impact12');
            $table->float('impact13');
            $table->float('impact14');
            $table->float('impact15');
            $table->float('impact16');
            $table->float('impact17');
            $table->float('impact18');
            $table->float('impact19');

            $table->timestamps(); // Created_at and updated_at

            // Foreign key constraints (if necessary)
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_3_b');
    }
}
