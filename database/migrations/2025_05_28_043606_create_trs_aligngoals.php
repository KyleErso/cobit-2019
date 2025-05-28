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
        Schema::create('trs_aligngoals', function (Blueprint $table) {
            $table->string('objective_id');
            $table->string('aligngoals_id');
            // $table->string('domain')->nullable();

            $table->primary(['objective_id', 'aligngoals_id']);

            $table->foreign('objective_id')->references('objective_id')->on('mst_objective')->onDelete('cascade');
            $table->foreign('aligngoals_id')->references('aligngoals_id')->on('mst_aligngoals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_aligngoals');
    }
};
