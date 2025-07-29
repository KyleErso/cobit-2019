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
        Schema::create('trs_entergoals', function (Blueprint $table) {
            $table->string('objective_id');
            $table->string('entergoals_id');
            // $table->string('domain')->nullable();

            $table->primary(['objective_id', 'entergoals_id']);

            $table->foreign('objective_id')->references('objective_id')->on('mst_objective')->onDelete('cascade');
            $table->foreign('entergoals_id')->references('entergoals_id')->on('mst_entergoals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_entergoals');
    }
};
