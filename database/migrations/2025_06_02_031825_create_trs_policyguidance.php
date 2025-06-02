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
        Schema::create('trs_policyguidance', function (Blueprint $table) {
            $table->integer("policy_id");
            $table->integer("guidance_id");
            $table->string("component")->nullable();
            // No timestamps

            // Composite primary key
            $table->primary(["policy_id", "guidance_id"]);

            // Foreign keys
            $table->foreign("policy_id")->references("policy_id")->on("mst_policy")->onDelete("cascade");
            $table->foreign("guidance_id")->references("guidance_id")->on("mst_guidance")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_policyguidance');
    }
};
