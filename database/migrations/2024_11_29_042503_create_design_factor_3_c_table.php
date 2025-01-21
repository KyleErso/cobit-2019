<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFactor3CTable extends Migration
{
    public function up()
    {
        Schema::create('design_factor_3_c', function (Blueprint $table) {
            $table->id('df3c_id'); // Primary key
            $table->unsignedBigInteger('id'); // Foreign key to users table
            $table->unsignedBigInteger('df_id'); // Foreign key to related view or button

            // Likelihood fields (replacing impact fields)
            $table->float('likelihood1');
            $table->float('likelihood2');
            $table->float('likelihood3');
            $table->float('likelihood4');
            $table->float('likelihood5');
            $table->float('likelihood6');
            $table->float('likelihood7');
            $table->float('likelihood8');
            $table->float('likelihood9');
            $table->float('likelihood10');
            $table->float('likelihood11');
            $table->float('likelihood12');
            $table->float('likelihood13');
            $table->float('likelihood14');
            $table->float('likelihood15');
            $table->float('likelihood16');
            $table->float('likelihood17');
            $table->float('likelihood18');
            $table->float('likelihood19');

            $table->timestamps(); // Created_at and updated_at

            // Foreign key constraints (if necessary)
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_factor_3_c');
    }
}
