<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    
    public function up(): void {
        DB::table('users')->where('role', 'admin')->update(['role' => 'pic']);
    }

    public function down(): void {
        DB::table('users')->where('role', 'pic')->update(['role' => 'admin']);
    }
};
