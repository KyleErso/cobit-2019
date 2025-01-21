<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor5Table extends Migration
{
    public function up()
    {
        Schema::create('design_factor_5', function (Blueprint $table) {
            $table->id('df5_id'); 
            $table->unsignedBigInteger('id'); 
            $table->unsignedBigInteger('df_id'); 
            $table->float('input1df5');
            $table->float('input2df5');
            $table->timestamps(); 
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_5');
    }
}
