<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create("analytics_logs", function (Blueprint $table) {
      $table->id();

      $table->ipAddress("ip_address");

      $table->string("log_type");

      $table
        ->foreignId("layanan_id")
        ->nullable()
        ->constrained("layanans")
        ->cascadeOnDelete();

      $table->text("user_agent")->nullable();

      $table->date("visited_at");

      $table->timestamps();

      // Mempercepat pencarian berdasarkan tanggal dan jenis kunjungan.
      $table->index(["visited_at", "log_type"]);

      // Mempercepat statistik per layanan berdasarkan tanggal.
      $table->index(["layanan_id", "visited_at"]);

      $table->unique(["ip_address", "visited_at", "log_type", "layanan_id"]);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists("analytics_logs");
  }
};
