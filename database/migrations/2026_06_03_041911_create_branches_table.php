<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('code')->unique()->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();

            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();

            $table->string('gst_number')->nullable();
            $table->string('fssai_license')->nullable();

            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};