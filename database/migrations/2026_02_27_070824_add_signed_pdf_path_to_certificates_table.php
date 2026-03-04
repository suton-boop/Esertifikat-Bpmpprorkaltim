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
        if (!Schema::hasColumn('certificates', 'signed_pdf_path')) {
            Schema::table('certificates', function (Blueprint $table) {
                $table->string('signed_pdf_path')->nullable()->after('pdf_path');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('signed_pdf_path')->nullable()->after('pdf_path');
        });
    }


};
