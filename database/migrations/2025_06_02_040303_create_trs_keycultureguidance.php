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
        Schema::create('trs_keycultureguidance', function (Blueprint $table) {
            $table->integer("keyculture_id");
            $table->integer("guidance_id");
            // No timestamps

            // Composite primary key
            $table->primary(["keyculture_id", "guidance_id"]);

            // Foreign keys
            $table->foreign("keyculture_id")->references("keyculture_id")->on("mst_keyculture")->onDelete("cascade");
            $table->foreign("guidance_id")->references("guidance_id")->on("mst_guidance")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_keycultureguidance');
    }
};
