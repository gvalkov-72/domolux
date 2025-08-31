<?php

use Illuminate\Support\Facades\Auth;

return [

    'title' => 'Admin Panel',
    'title_prefix' => '',
    'title_postfix' => '',

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'logo' => '<b>DOMO</b> LUXE',
    'logo_img' => 'vendor/adminlte/dist/img/logo_broker004.jpg',
    'logo_img_class' => 'brand-image elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'cFlow',

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo_broker004.jpg',
            'alt' => 'Auth Logo',
            'class' => 'brand-image elevation-3',
            'width' => 110,
            'height' => 80,
        ],
    ],

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => false,
    'layout_dark_mode' => false,

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'control_sidebar' => false,
    'control_sidebar_theme' => 'dark',
    'control_sidebar_slide' => true,
    'control_sidebar_push' => true,
    'control_sidebar_scrollbar_theme' => 'os-theme-light',
    'control_sidebar_scrollbar_auto_hide' => 'l',

    'logout_method' => 'POST',
    'login_url' => 'login',
    'logout_url' => 'logout',
    'dashboard_url' => 'dashboard',
    'register_url' => false,
    'password_reset_url' => false,
    'password_email_url' => false,

    'menu' => [

    ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [],

    'livewire' => false,

    // Добавяме системата за права
    'permission' => [
        'enabled' => true,
        'handler' => function ($permission) {
            $user = Auth::user();

            if ($user instanceof \App\Models\User) {
                return $user->hasPermission($permission);
            }

            return false;
        },
    ],
];
