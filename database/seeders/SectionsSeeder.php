<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\SectionItem;
use App\Models\Translation;

class SectionsSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        $hero = Section::create([
            'type'      => 'hero',
            'key'       => 'home_hero',
            'position'  => 1,
            'is_active' => true,
        ]);

        Translation::insert([
            [
                'translatable_type' => Section::class,
                'translatable_id'   => $hero->id,
                'locale'            => 'bg',
                'key'               => 'title',
                'value'             => 'Добре дошли в Домо Лукс',
            ],
            [
                'translatable_type' => Section::class,
                'translatable_id'   => $hero->id,
                'locale'            => 'en',
                'key'               => 'title',
                'value'             => 'Welcome to Domo Lux',
            ],
        ]);

        $heroItem = SectionItem::create([
            'section_id' => $hero->id,
            'image'      => 'demo/hero.jpg',
            'url'        => null,
            'position'   => 1,
            'is_active'  => true,
        ]);

        Translation::insert([
            [
                'translatable_type' => SectionItem::class,
                'translatable_id'   => $heroItem->id,
                'locale'            => 'bg',
                'key'               => 'title',
                'value'             => 'Луксозни имоти за вашия дом',
            ],
            [
                'translatable_type' => SectionItem::class,
                'translatable_id'   => $heroItem->id,
                'locale'            => 'en',
                'key'               => 'title',
                'value'             => 'Luxury properties for your home',
            ],
        ]);

        // Services Section
        $services = Section::create([
            'type'      => 'services',
            'key'       => 'home_services',
            'position'  => 2,
            'is_active' => true,
        ]);

        Translation::insert([
            [
                'translatable_type' => Section::class,
                'translatable_id'   => $services->id,
                'locale'            => 'bg',
                'key'               => 'title',
                'value'             => 'Нашите услуги',
            ],
            [
                'translatable_type' => Section::class,
                'translatable_id'   => $services->id,
                'locale'            => 'en',
                'key'               => 'title',
                'value'             => 'Our Services',
            ],
        ]);

        $serviceItem = SectionItem::create([
            'section_id' => $services->id,
            'image'      => 'demo/service1.png',
            'url'        => null,
            'position'   => 1,
            'is_active'  => true,
        ]);

        Translation::insert([
            [
                'translatable_type' => SectionItem::class,
                'translatable_id'   => $serviceItem->id,
                'locale'            => 'bg',
                'key'               => 'title',
                'value'             => 'Покупка на имот',
            ],
            [
                'translatable_type' => SectionItem::class,
                'translatable_id'   => $serviceItem->id,
                'locale'            => 'en',
                'key'               => 'title',
                'value'             => 'Property Purchase',
            ],
        ]);

        // Testimonials Section
        $testimonials = Section::create([
            'type'      => 'testimonials',
            'key'       => 'home_testimonials',
            'position'  => 3,
            'is_active' => true,
        ]);

        Translation::insert([
            [
                'translatable_type' => Section::class,
                'translatable_id'   => $testimonials->id,
                'locale'            => 'bg',
                'key'               => 'title',
                'value'             => 'Отзиви на клиенти',
            ],
            [
                'translatable_type' => Section::class,
                'translatable_id'   => $testimonials->id,
                'locale'            => 'en',
                'key'               => 'title',
                'value'             => 'Customer Testimonials',
            ],
        ]);

        $testimonialItem = SectionItem::create([
            'section_id' => $testimonials->id,
            'image'      => null,
            'url'        => null,
            'position'   => 1,
            'is_active'  => true,
        ]);

        Translation::insert([
            [
                'translatable_type' => SectionItem::class,
                'translatable_id'   => $testimonialItem->id,
                'locale'            => 'bg',
                'key'               => 'content',
                'value'             => 'Страхотна агенция! Намериха мечтания ми дом.',
            ],
            [
                'translatable_type' => SectionItem::class,
                'translatable_id'   => $testimonialItem->id,
                'locale'            => 'en',
                'key'               => 'content',
                'value'             => 'Great agency! They found my dream home.',
            ],
        ]);
    }
}
