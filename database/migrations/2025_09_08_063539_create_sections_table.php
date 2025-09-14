<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // например: hero, services, agents, testimonials
            $table->string('key')->nullable(); // уникален ключ/slug за секцията (optional)
            $table->unsignedInteger('position')->default(0); // подредба
            $table->boolean('is_active')->default(true);
            $table->json('settings')->nullable(); // допълнителни опции/настройки за секцията
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // ако искаш: foreign keys към users (коментарно)
            // $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            // $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
