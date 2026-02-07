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
        Schema::create('failure_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('failure_log_id')->constrained('failure_logs')->onDelete('cascade');
            $table->string('root_cause')->nullable();
            $table->json('contributing_factors')->nullable(); // array of factors
            $table->json('mitigation')->nullable(); // array of steps
            $table->json('prevention')->nullable(); // array of measures
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failure_analyses');
    }
};
