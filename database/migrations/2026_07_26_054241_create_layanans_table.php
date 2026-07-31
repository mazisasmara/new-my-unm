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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
              ->constrained()
              ->cascadeOnDelete();
         
            $table->foreignId('created_by')
              ->nullable()
              ->constrained('users')
              ->cascadeOnDelete();
            $table->string('nama_layanan');
            $table->string('logo')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('link')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
