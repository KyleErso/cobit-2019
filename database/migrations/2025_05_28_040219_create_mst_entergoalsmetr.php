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
        Schema::create('mst_entergoalsmetr', function (Blueprint $table) {
            $table->increments('entergoalsmetr_id');
            // $table->primary('entergoalsmetr_id');

            $table->string('description');
            $table->string('entergoals_id');

            $table->foreign('entergoals_id')
            ->references('entergoals_id')
            ->on('mst_entergoals')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_entergoalsmetr');
    }
};
