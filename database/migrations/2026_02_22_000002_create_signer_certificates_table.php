<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('signer_certificates', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('code')->unique();
            $table->string('name');
            $table->string('fingerprint')->nullable();
            $table->longText('public_key')->nullable();
            $table->longText('private_key_encrypted')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signer_certificates');
    }
};