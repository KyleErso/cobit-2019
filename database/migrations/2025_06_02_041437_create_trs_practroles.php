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
        Schema::create('trs_practroles', function (Blueprint $table) {
            $table->string("practice_id");
            $table->integer("role_id");
            // Ignoring r_a as placeholder
            // No timestamps
            $table->string("r_a")->nullable();

            // Composite primary key
            $table->primary(["practice_id", "role_id"]);

            // Foreign keys
            $table->foreign("practice_id")->references("practice_id")->on("mst_practice")->onDelete("cascade");
            $table->foreign("role_id")->references("role_id")->on("mst_roles")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_practroles');
    }
};
