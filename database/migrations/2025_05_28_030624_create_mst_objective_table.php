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
        Schema::create('mst_objective', function (Blueprint $table) {
            $table->string('objective_id');
            $table->primary('objective_id');

            $table->string('objective');
            $table->text('objective_description')->nullable();
            $table->text('objective_purpose')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_objective');
    }
};
