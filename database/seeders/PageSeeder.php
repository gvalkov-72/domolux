<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            // About Page
            $about = Page::create([
                'slug' => 'about',
                'seo_title' => 'About Us',
                'seo_description' => 'Learn more about our company',
                'meta_keywords' => 'about, company, info',
                'template' => 'default',
                'is_active' => true,
                'sort_order' => 1,
            ]);

            $about->setTranslation('title', 'bg', 'За нас');
            $about->setTranslation('title', 'en', 'About Us');
            $about->setTranslation('content', 'bg', '<p>Ние сме водеща брокерска къща с дългогодишен опит в недвижимите имоти.</p>');
            $about->setTranslation('content', 'en', '<p>We are a leading real estate agency with many years of experience.</p>');
            $about->setTranslation('excerpt', 'bg', 'Информация за нашата компания');
            $about->setTranslation('excerpt', 'en', 'Information about our company');
            $about->save();

            // Services Page
            $services = Page::create([
                'slug' => 'services',
                'seo_title' => 'Our Services',
                'seo_description' => 'Real estate services we provide',
                'meta_keywords' => 'services, real estate',
                'template' => 'default',
                'is_active' => true,
                'sort_order' => 2,
            ]);

            $services->setTranslation('title', 'bg', 'Нашите услуги');
            $services->setTranslation('title', 'en', 'Our Services');
            $services->setTranslation('content', 'bg', '<ul><li>Покупко-продажби</li><li>Наеми</li><li>Консултации</li></ul>');
            $services->setTranslation('content', 'en', '<ul><li>Buying and Selling</li><li>Rentals</li><li>Consulting</li></ul>');
            $services->setTranslation('excerpt', 'bg', 'Услуги в сферата на недвижимите имоти');
            $services->setTranslation('excerpt', 'en', 'Real estate services we provide');
            $services->save();

            // Contact Page
            $contact = Page::create([
                'slug' => 'contact',
                'seo_title' => 'Contact Us',
                'seo_description' => 'Get in touch with us',
                'meta_keywords' => 'contact, address, phone',
                'template' => 'default',
                'is_active' => true,
                'sort_order' => 3,
            ]);

            $contact->setTranslation('title', 'bg', 'Контакти');
            $contact->setTranslation('title', 'en', 'Contact');
            $contact->setTranslation('content', 'bg', '<p>Свържете се с нас чрез формата за контакт или на посочените телефони.</p>');
            $contact->setTranslation('content', 'en', '<p>Contact us via the contact form or by phone.</p>');
            $contact->setTranslation('excerpt', 'bg', 'Как да се свържете с нас');
            $contact->setTranslation('excerpt', 'en', 'How to get in touch with us');
            $contact->save();
        });
    }
}
