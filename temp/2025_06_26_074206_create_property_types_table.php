<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_property_types_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('property_types');
    }
};
