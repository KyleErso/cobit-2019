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
        Schema::create('mst_policy', function (Blueprint $table) {
            $table->integer("policy_id");
            $table->string("objective_id")->nullable();
            $table->text("policy")->nullable();
            $table->text("description")->nullable();
            // No timestamps
            $table->primary("policy_id");

            $table->foreign("objective_id")->references("objective_id")->on("mst_objective")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_policy');
    }
};
