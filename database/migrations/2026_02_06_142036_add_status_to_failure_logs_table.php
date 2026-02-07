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
        Schema::table('failure_logs', function (Blueprint $table) {
            $table->enum('status', ['open', 'analyzed', 'escalated', 'resolved'])
                ->default('open')
                ->after('stack_trace'); // place it after retry_count for clarity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('failure_logs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
