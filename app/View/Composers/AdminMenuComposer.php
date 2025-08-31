<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Config;

class AdminMenuComposer
{
    public function compose($view)
    {
        Config::set('adminlte.menu', [

            // Админ панел
            [
                'text' => __('languages.admin_panel_title'),
                'route' => 'dashboard',
                'icon'  => 'fas fa-tachometer-alt',
            ],

            // Потребители и роли
            [
                'text' => __('languages.users_title'),
                'route' => 'admin.users.index',
                'icon'  => 'fas fa-users',
                'can'   => 'view-users',
            ],
            [
                'text' => __('languages.roles_header'),
                'route' => 'admin.roles.index',
                'icon'  => 'fas fa-user-shield',
                'can'   => 'view-roles',
            ],
            [
                'text' => __('languages.permissions'),
                'route' => 'admin.permissions.index',
                'icon'  => 'fas fa-key',
                'can'   => 'view-permissions',
            ],
            [
                'text' => __('languages.languages_title'),
                'route' => 'admin.languages.index',
                'icon'  => 'fas fa-language',
                'can'   => 'view-languages',
            ],

            // Локации
            [
                'text' => __('countries.title'),
                'route' => 'admin.countries.index',
                'icon'  => 'fas fa-flag',
                'can'   => 'view-countries',
            ],
            [
                'text' => __('cities.title'),
                'route' => 'admin.cities.index',
                'icon'  => 'fas fa-city',
                'can'   => 'view-cities',
            ],
            [
                'text' => __('districts.title'),
                'route' => 'admin.districts.index',
                'icon'  => 'fas fa-map-marker-alt',
                'can'   => 'view-districts',
            ],
            [
                'text' => __('locations.title'),
                'route' => 'admin.locations.index',
                'icon'  => 'fas fa-map',
                'can'   => 'view-locations',
            ],

            // Имоти
            [
                'text' => __('properties.title'),
                'route' => 'admin.properties.index',
                'icon'  => 'fas fa-home',
                'can'   => 'view-properties',
            ],
            
            [
                'text' => __('property_types.title'),
                'route' => 'admin.property_types.index',
                'icon'  => 'fas fa-list',
                'can'   => 'view-property_types',
            ],
            [
                'text' => __('extras.extras'),
                'route' => 'admin.extras.index',
                'icon'  => 'fas fa-star',
                'can'   => 'view-extras',
            ],
            [
                'text' => __('pages.title'),
                'route' => 'admin.pages.index',
                'icon'  => 'fas fa-file-alt',
                'can'   => 'view-pages',
            ],
            [
                'text' => __('property_images.title'),
                'route' => 'admin.property_images.index',
                'icon'  => 'fas fa-images',
                'can'   => 'view-property_images',
            ],
        ]);
    }
}
