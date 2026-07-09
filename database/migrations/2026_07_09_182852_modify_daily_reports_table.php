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
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->dropColumn('tips');
            $table->integer('completed_orders_count')->default(0)->after('fees');
            $table->integer('rejected_orders_count')->default(0)->after('completed_orders_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->decimal('tips', 10, 2)->default(0);
            $table->dropColumn(['completed_orders_count', 'rejected_orders_count']);
        });
    }
};
