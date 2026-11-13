<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->text('informasi_dokumen')
                ->nullable()
                ->after('link');

            $table->string('link_dokumen')
                ->nullable()
                ->after('informasi_dokumen');

            $table->string('link_panduan')
                ->nullable()
                ->after('link_dokumen');
        });
    }

    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn([
                'informasi_dokumen',
                'link_dokumen',
                'link_panduan',
            ]);
        });
    }
};
