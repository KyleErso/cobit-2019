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
        Schema::create('trs_domain', function (Blueprint $table) {
            $table->string('area');
            $table->string('objective_id');
            $table->string('domain')->nullable();

            $table->primary(['area', 'objective_id']);

            $table->foreign('area')->references('area')->on('mst_area')->onDelete('cascade');
            $table->foreign('objective_id')->references('objective_id')->on('mst_objective')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_domain');
    }
};
