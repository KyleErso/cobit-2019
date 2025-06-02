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
        Schema::create('mst_practice', function (Blueprint $table) {
            $table->string("practice_id");
            $table->string("objective_id");
            $table->string("practice_name")->nullable();
            $table->text("practice_description")->nullable();

            $table->foreign("objective_id")->references("objective_id")->on("mst_objective")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_practice');
    }
};
