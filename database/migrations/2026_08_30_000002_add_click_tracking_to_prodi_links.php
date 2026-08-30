<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodi_links', function (Blueprint $table) {
            $table->unsignedBigInteger('clicks')->default(0)->after('url');
        });

        Schema::table('analytics_logs', function (Blueprint $table) {
            $table->foreignId('prodi_link_id')->nullable()->after('layanan_id')
                ->constrained('prodi_links')->cascadeOnDelete();
            $table->index(['prodi_link_id', 'visited_at']);
        });
    }

    public function down(): void
    {
        Schema::table('analytics_logs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('prodi_link_id');
        });

        Schema::table('prodi_links', function (Blueprint $table) {
            $table->dropColumn('clicks');
        });
    }
};
