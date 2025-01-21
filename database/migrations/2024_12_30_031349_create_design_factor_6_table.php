<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor6Table extends Migration
{
    public function up()
    {
        Schema::create('design_factor_6', function (Blueprint $table) {
            $table->id('df6_id'); 
            $table->unsignedBigInteger('id'); 
            $table->unsignedBigInteger('df_id'); 
            $table->float('input1df6');
            $table->float('input2df6');
            $table->float('input3df6');
            $table->timestamps(); 
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_6');
    }
}
