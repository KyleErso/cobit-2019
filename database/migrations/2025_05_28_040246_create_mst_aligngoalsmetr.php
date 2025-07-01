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
        Schema::create('mst_aligngoalsmetr', function (Blueprint $table) {
            $table->increments('aligngoalsmetr_id');
            // $table->primary('aligngoalsmetr_id');

            
            $table->string('aligngoals_id');
            $table->text('description');
            $table->foreign('aligngoals_id')
            ->references('aligngoals_id')
            ->on('mst_aligngoals')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_aligngoalsmetr');
    }
};
