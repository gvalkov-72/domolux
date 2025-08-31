<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->integer('area'); // площ в кв.м.
            $table->integer('rooms');
            $table->integer('floor')->nullable();
            $table->integer('total_floors')->nullable();
            $table->string('furnishing')->nullable(); // необзаведен, частично, напълно
            $table->string('main_image')->nullable();
            $table->boolean('is_published')->default(false);
            $table->date('published_at')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->integer('position')->default(0); // за drag & drop
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('properties');
    }
};
