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
        Schema::create('mst_activities', function (Blueprint $table) {
            $table->id("activity_id");
            $table->string("practice_id")->nullable();
            $table->text("description")->nullable();
            $table->integer("capability_lvl")->nullable();

            $table->foreign("practice_id")->references("practice_id")->on("mst_practice")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_activities');
    }
};
