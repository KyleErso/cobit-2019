<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor7Table extends Migration
{
    public function up()
    {
        Schema::create('design_factor_7', function (Blueprint $table) {
            $table->id('df7_id'); 
            $table->unsignedBigInteger('id'); 
            $table->unsignedBigInteger('df_id'); 
            $table->float('input1df7');
            $table->float('input2df7');
            $table->float('input3df7');
            $table->float('input4df7');
            $table->timestamps(); 
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_7');
    }
}
