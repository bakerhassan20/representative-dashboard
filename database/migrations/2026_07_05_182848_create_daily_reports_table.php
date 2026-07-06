<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('report_date');

            $table->string('phone',20);

            $table->decimal('earned_amount',10,2)->default(0);
            $table->decimal('fees',10,2)->default(0);
            $table->decimal('tips',10,2)->default(0);

            $table->decimal('delivery_hours',5,2)->default(0);

            $table->string('vehicle_type')->nullable();

            $table->string('payment_image')->nullable();

            $table->text('notes')->nullable();

            $table->boolean('allow_resubmit')->default(false);

            $table->enum('status',[
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->timestamps();

            $table->unique(['client_id','report_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_reports');
    }
};