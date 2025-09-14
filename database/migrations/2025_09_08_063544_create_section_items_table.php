<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();

            // Връзка към секция
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();

            // Връзка към имот (опционална)
            $table->foreignId('property_id')
                  ->nullable()
                  ->constrained('properties')
                  ->nullOnDelete();

            $table->string('image')->nullable(); // път към изображение (storage или public)
            $table->string('url')->nullable();   // целия линк (пример: link към property)
            $table->unsignedInteger('position')->default(0); // подредба на елементите в секцията
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            // Ако желаеш FK към users (по желание):
            // $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            // $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_items');
    }
};
