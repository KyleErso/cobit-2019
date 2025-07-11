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
        Schema::create('mst_practicemetr', function (Blueprint $table) {
            $table->id();
            $table->string("practice_id")->nullable();
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
        Schema::dropIfExists('mst_practicemetr');
    }
};
