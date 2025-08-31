<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            [
                'code' => 'bg',
                'name' => 'Български',
                'is_active' => true,
                'is_default_admin' => true,
                'is_default_site' => false,
                'description' => 'Български език за администраторския панел',
                'position' => 1,
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'is_active' => true,
                'is_default_admin' => false,
                'is_default_site' => true,
                'description' => 'English language for the website',
                'position' => 2,
            ],
            [
                'code' => 'de',
                'name' => 'Deutsch',
                'is_active' => true,
                'is_default_admin' => false,
                'is_default_site' => false,
                'description' => 'German language',
                'position' => 3,
            ],
            [
                'code' => 'fr',
                'name' => 'Français',
                'is_active' => true,
                'is_default_admin' => false,
                'is_default_site' => false,
                'description' => 'French language',
                'position' => 4,
            ],
            [
                'code' => 'es',
                'name' => 'Español',
                'is_active' => true,
                'is_default_admin' => false,
                'is_default_site' => false,
                'description' => 'Spanish language',
                'position' => 5,
            ],
        ];

        foreach ($languages as $lang) {
            Language::create($lang);
        }
    }
}
