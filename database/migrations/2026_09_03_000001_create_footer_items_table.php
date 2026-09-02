<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_items', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('label');
            $table->text('value')->nullable();
            $table->string('url', 2048)->nullable();
            $table->string('icon', 30)->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['type', 'status', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_items');
    }
};
