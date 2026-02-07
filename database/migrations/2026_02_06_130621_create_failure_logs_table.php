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
        Schema::create('failure_logs', function (Blueprint $table) {
            $table->id();
            $table->string('job');
            $table->string('error');
            $table->string('exception');
            $table->integer('http_status')->nullable();
            $table->integer('retry_count')->default(0);

            // Observed conditions
            $table->integer('latency_ms')->nullable();
            $table->integer('memory_limit_mb')->nullable();
            $table->integer('dependency_timeout_ms')->nullable();

            $table->text('stack_trace');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failure_logs');
    }
};
