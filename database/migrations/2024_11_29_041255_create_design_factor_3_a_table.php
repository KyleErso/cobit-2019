<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor3aTable extends Migration
{
    public function up()
    {
        Schema::create('design_factor_3_a', function (Blueprint $table) {
            $table->id('df3_id'); // Primary key
            $table->unsignedBigInteger('id'); // Foreign key to users table
            $table->unsignedBigInteger('df_id'); // Foreign key to related view or button

            $table->float('input1df3');
            $table->float('input2df3');
            $table->float('input3df3');
            $table->float('input4df3');
            $table->float('input5df3');
            $table->float('input6df3');
            $table->float('input7df3');
            $table->float('input8df3');
            $table->float('input9df3');
            $table->float('input10df3');
            $table->float('input11df3');
            $table->float('input12df3');
            $table->float('input13df3');
            $table->float('input14df3');
            $table->float('input15df3');
            $table->float('input16df3');
            $table->float('input17df3');
            $table->float('input18df3');
            $table->float('input19df3');

            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Foreign key constraints (if necessary, add foreign key constraints)
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_3_a');
    }
}
