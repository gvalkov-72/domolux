<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('property_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->foreignId('district_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();

            $table->unsignedBigInteger('user_id'); // брокер - потребител
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('area', 8, 2)->nullable();
            $table->unsignedSmallInteger('floor')->nullable();
            $table->unsignedSmallInteger('rooms')->nullable();

            // ✅ Тип оферта (продажба / наем)
            $table->string('offer_type')->default('sale'); // sale = продажба, rent = наем

            // ✅ Уникален код на имота (например PROP-001)
            $table->string('code')->unique();

            $table->string('cover_image')->nullable(); // път до корица на снимка
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
