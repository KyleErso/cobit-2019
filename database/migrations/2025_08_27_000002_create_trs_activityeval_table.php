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
        Schema::create('trs_activityeval', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eval_id');
            $table->unsignedBigInteger('activity_id');
            $table->enum('level_achieved', ['N', 'P', 'L', 'F']);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('eval_id')->references('eval_id')->on('mst_eval')->onDelete('cascade');
            $table->foreign('activity_id')->references('activity_id')->on('mst_activities')->onDelete('cascade');
            
            $table->unique(['eval_id', 'activity_id'], 'unique_eval_activity');
            
            $table->index('eval_id');
            $table->index('level_achieved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_activityeval');
    }
};
