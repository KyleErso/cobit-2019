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
        Schema::create('mst_guidance', function (Blueprint $table) {
            $table->integer("guidance_id");
            $table->text("guidance")->nullable();
            $table->text("reference")->nullable();
            $table->primary("guidance_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_guidance');
    }
};
