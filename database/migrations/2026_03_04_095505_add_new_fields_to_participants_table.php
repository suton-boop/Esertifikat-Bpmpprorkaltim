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
        Schema::table('participants', function (Blueprint $table) {
            $table->string('daerah')->nullable()->after('institution');
            $table->string('jenjang')->nullable()->after('daerah');
            $table->string('peran')->nullable()->after('jenjang');
            $table->text('keterangan')->nullable()->after('peran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn(['daerah', 'jenjang', 'peran', 'keterangan']);
        });
    }
};
