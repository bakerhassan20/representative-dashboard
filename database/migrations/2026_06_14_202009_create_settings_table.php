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
        Schema::create('settings', function (Blueprint $table) {

            $table->id();

            $table->string('site_name')->nullable();
            $table->string('site_description')->nullable();

            $table->string('logo')->nullable();

            $table->string('favicon')->nullable();

            $table->string('primary_color')
                ->default('#0d6efd');

            $table->string('secondary_color')
                ->default('#6c757d');

            $table->boolean('dark_mode')
                ->default(false);

            $table->string('currency')
                ->default('EGP');

            $table->string('timezone')
                ->default('Africa/Cairo');

            $table->string('footer_text')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
