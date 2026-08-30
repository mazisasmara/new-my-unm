<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('analytics_logs', function (Blueprint $table) {
            // Nullable keeps historical rows migration-safe. New records always
            // receive a fingerprint and are atomically deduplicated by MySQL.
            $table->string('visitor_key', 64)->nullable()->after('ip_address');
            $table->unique('visitor_key', 'analytics_logs_visitor_key_unique');
            $table->index(
                ['log_type', 'visited_at', 'ip_address'],
                'analytics_logs_visit_lookup_index',
            );
        });
    }

    public function down(): void
    {
        Schema::table('analytics_logs', function (Blueprint $table) {
            $table->dropIndex('analytics_logs_visit_lookup_index');
            $table->dropUnique('analytics_logs_visitor_key_unique');
            $table->dropColumn('visitor_key');
        });
    }
};
