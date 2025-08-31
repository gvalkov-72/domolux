<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            $table->string('key');
            $table->text('value')->nullable();
            $table->morphs('translatable'); // polymorphic relation
            $table->timestamps();

            $table->index(['locale', 'key']);
            $table->unique(['translatable_type', 'translatable_id', 'locale', 'key'], 'translations_unique');
        });
    }

    public function down(): void {
        Schema::dropIfExists('translations');
    }
};
