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
        Schema::create('trs_skillguidance', function (Blueprint $table) {
            $table->unsignedBigInteger("skill_id");
            $table->integer("guidance_id");
            // No timestamps

            $table->primary(["skill_id", "guidance_id"]);

            $table->foreign("skill_id")->references("skill_id")->on("mst_skill")->onDelete("cascade");
            $table->foreign("guidance_id")->references("guidance_id")->on("mst_guidance")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_skillguidance');
    }
};
