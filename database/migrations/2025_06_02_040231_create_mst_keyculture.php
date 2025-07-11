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
        Schema::create('mst_keyculture', function (Blueprint $table) {
            $table->id("keyculture_id");
            // $table->primary("keyculture_id");
            $table->string("objective_id");
            $table->text("element")->nullable();

            $table->foreign("objective_id")->references("objective_id")->on("mst_objective")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_keyculture');
    }
};
