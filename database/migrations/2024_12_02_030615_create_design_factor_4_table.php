<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor4Table extends Migration
{
    public function up()
    {
        Schema::create('design_factor_4', function (Blueprint $table) {
            $table->id('df4_id'); // Primary key
            $table->unsignedBigInteger('id'); // Foreign key to users table
            $table->unsignedBigInteger('df_id'); // Foreign key to related view or button

            $table->float('input1df4');
            $table->float('input2df4');
            $table->float('input3df4');
            $table->float('input4df4');
            $table->float('input5df4');
            $table->float('input6df4');
            $table->float('input7df4');
            $table->float('input8df4');
            $table->float('input9df4');
            $table->float('input10df4');
            $table->float('input11df4');
            $table->float('input12df4');
            $table->float('input13df4');
            $table->float('input14df4');
            $table->float('input15df4');
            $table->float('input16df4');
            $table->float('input17df4');
            $table->float('input18df4');
            $table->float('input19df4');
            $table->float('input20df4');

            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Foreign key constraints
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_4');
    }
}
