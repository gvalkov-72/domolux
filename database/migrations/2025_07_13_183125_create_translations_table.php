<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5); // Пример: bg, en, fr
            $table->string('key'); // Пример: name, description
            $table->text('value')->nullable();

            $table->morphs('translatable'); // translatable_id, translatable_type

            $table->timestamps();
            $table->unique(['locale', 'key', 'translatable_id', 'translatable_type'], 'translations_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
