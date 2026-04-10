<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // true  = data dari admin (terpercaya)
            // false = siswa daftar sendiri saat scan (perlu review admin)
            $table->boolean('is_verified')->default(true)->after('remember_token');
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('is_verified');
        });
    }
};
