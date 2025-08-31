<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('extras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('extra_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extra_id')->constrained('extras')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->timestamps();
            $table->unique(['extra_id', 'locale']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('extra_translations');
        Schema::dropIfExists('extras');
    }
};
