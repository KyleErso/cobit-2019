<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mst_infoflowinput', function (Blueprint $table) {
            $table->unsignedBigInteger("input_id");
            $table->primary("input_id");
            // $table->integer("practice_id")->nullable();
            $table->string("practice_id")->nullable();
            $table->string("from")->nullable();
            $table->text("description")->nullable();
            // No timestamps

            $table->foreign("practice_id")->references("practice_id")->on("mst_practice")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_infoflowinput');
    }
};
