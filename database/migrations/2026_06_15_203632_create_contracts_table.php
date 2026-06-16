<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('car_name');

            $table->decimal('car_price', 12, 2);

            $table->decimal('interest_value', 12, 2)
                ->default(0);

            $table->decimal('total_amount', 12, 2);

            $table->integer('installments_count');

            $table->decimal('installment_amount', 12, 2);

            $table->date('start_date');

            $table->enum('status', [
                'active',
                'completed',
                'cancelled'
            ])->default('active');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};