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
        Schema::create('trs_practiceguidance', function (Blueprint $table) {
            $table->string("practice_id");
            $table->integer("guidance_id");
            // $table->string("component")->nullable();
            // No timestamps

            // Composite primary key
            $table->primary(["practice_id", "guidance_id"]);

            // Foreign keys
            $table->foreign("practice_id")->references("practice_id")->on("mst_practice")->onDelete("cascade");
            $table->foreign("guidance_id")->references("guidance_id")->on("mst_guidance")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_practiceguidance');
    }
};
