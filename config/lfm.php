<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    'use_package_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | Folder Settings
    |--------------------------------------------------------------------------
    */

    'allow_private_folder' => true,
    'private_folder_name'  => UniSharp\LaravelFilemanager\Handlers\ConfigHandler::class,
    'allow_shared_folder'  => true,
    'shared_folder_name'   => 'shares',

    /*
    |--------------------------------------------------------------------------
    | Folder Categories
    |--------------------------------------------------------------------------
    */

    'folder_categories' => [
        'file' => [
            'folder_name'  => 'files',
            'startup_view' => 'list',
            'max_size'     => 50000, // KB
            'thumb'        => true,
            'thumb_width'  => 80,
            'thumb_height' => 80,
            'valid_mime'   => [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
                'application/pdf',
                'text/plain',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/zip',
            ],
        ],
        'image' => [
            'folder_name'  => 'photos',
            'startup_view' => 'grid',
            'max_size'     => 50000, // KB
            'thumb'        => true,
            'thumb_width'  => 200,
            'thumb_height' => 200,
            'valid_mime'   => [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload / Validation
    |--------------------------------------------------------------------------
    */

    'disk' => 'public',

    'rename_file'            => false,
    'rename_duplicates'      => false,
    'alphanumeric_filename'  => false,
    'alphanumeric_directory' => false,
    'should_validate_size'   => true,
    'should_validate_mime'   => true,
    'over_write_on_duplicate'=> false,

    'disallowed_mimetypes' => ['text/x-php', 'text/html'],
    'disallowed_extensions'=> ['php', 'html'],

    /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
    */

    'should_create_thumbnails' => true,
    'thumb_folder_name'        => 'thumbs',
    'raster_mimetypes'         => ['image/jpeg', 'image/pjpeg', 'image/png'],
    'thumb_img_width'          => 200,
    'thumb_img_height'         => 200,

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    */

    'paginator' => [
        'perPage' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | php.ini override
    |--------------------------------------------------------------------------
    */

    'php_ini_overrides' => [
        'memory_limit' => '256M',
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Intervention Driver
    |--------------------------------------------------------------------------
    */

    'intervention_driver' => 'gd',
];
