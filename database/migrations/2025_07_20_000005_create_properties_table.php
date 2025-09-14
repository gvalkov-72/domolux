<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->integer('position')->default(0);

            // single foreign keys
            $table->foreignId('property_type_id')->nullable()->constrained('property_types')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // цени
            $table->decimal('price_bgn', 14, 2)->nullable();
            $table->decimal('price_eur', 14, 2)->nullable();
            $table->decimal('exchange_rate', 12, 6)->nullable(); // курс лев/евро

            $table->boolean('is_active')->default(true);
            $table->timestamp('active_from')->nullable();
            $table->timestamp('active_to')->nullable();

            $table->timestamps(); // created_at / updated_at
        });

        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained('properties')->cascadeOnDelete();
            $table->string('path'); // относителен път (storage)
            $table->string('disk')->default('public'); // диска
            $table->integer('position')->default(0);
            $table->boolean('is_cover')->default(false); // корица
            $table->timestamps();
        });

        if (!Schema::hasTable('extra_property')) {
            Schema::create('extra_property', function (Blueprint $table) {
                $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
                $table->foreignId('extra_id')->constrained('extras')->cascadeOnDelete();
                $table->primary(['property_id','extra_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('property_images');
        Schema::dropIfExists('extra_property');
        Schema::dropIfExists('properties');
    }
};
