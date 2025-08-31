<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('extra_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('extra_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['property_id', 'extra_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('extra_property');
    }
};
