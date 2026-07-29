<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
        Schema::table('dokumens', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
        Schema::table('sops', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
        Schema::table('dokumens', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
        Schema::table('sops', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
    }
};
