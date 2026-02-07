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
         Schema::create('chaos_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Chaos configuration
            $table->integer('latency_ms')->default(0);
            $table->float('packet_loss_percent')->default(0);
            $table->integer('memory_limit_mb')->nullable();
            $table->integer('cpu_throttle_percent')->default(0);
            $table->integer('dependency_timeout_ms')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chaos_profiles');
    }
};
