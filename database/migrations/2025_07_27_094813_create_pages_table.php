<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            // Уникален slug за достъп до страницата (пример: /about-us)
            $table->string('slug')->unique();

            // SEO полета (непреводими, защото са технически)
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // Възможност за избор на шаблон (ако има различни изгледи)
            $table->string('template')->nullable();

            // Йерархия (ако решим да има подстраници)
            $table->unsignedBigInteger('parent_id')->nullable();

            // Автор (администратор)
            $table->unsignedBigInteger('author_id')->nullable();

            // Дата на публикуване
            $table->timestamp('published_at')->nullable();

            // Публикуване/деактивиране
            $table->boolean('is_active')->default(true);

            // Подредба
            $table->integer('sort_order')->default(0);

            // Кой я е създал/редактирал
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            // Връзка към потребители (ако има таблица users)
            // $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            // $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
