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
        Schema::create('trs_infoflowio', function (Blueprint $table) {
            $table->unsignedBigInteger("input_id");
            $table->unsignedBigInteger("output_id");
            // No timestamps

            $table->primary(["input_id", "output_id"]);

            // Foreign keys
            $table->foreign("input_id")->references("input_id")->on("mst_infoflowinput")->onDelete("cascade");
            $table->foreign("output_id")->references("output_id")->on("mst_infoflowoutput")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_infoflowio');
    }
};
