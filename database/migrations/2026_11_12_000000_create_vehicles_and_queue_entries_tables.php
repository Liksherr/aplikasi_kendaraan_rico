<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('plate_number');
            $table->string('vehicle_type');
            $table->string('owner_name');
            $table->timestamps();

            $table->unique(['user_id', 'plate_number']);
        });

        Schema::create('queue_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('queue_number');
            $table->date('queue_date');
            $table->time('queue_time');
            $table->string('status')->default('Menunggu');
            $table->timestamps();

            $table->unique(['user_id', 'queue_date', 'queue_number']);
            $table->index(['user_id', 'queue_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('queue_entries');
        Schema::dropIfExists('vehicles');
    }
};
