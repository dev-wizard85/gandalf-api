<?php
return [
    'middleware' => ['oauth', 'applicationable.acl'],
    'user_model' => 'App\Models\User',
    'routes' => [
        'prefix' => '/api/v1/',
        'applications' => '/projects',
        'current_application' => '/projects/current',
        'consumers' => '/projects/consumers',
        'users' => '/projects/users',
    ],
    'scopes' => [
        'users' => [
            'create',
            'read',
            'update',
            'delete',
            'check',
            'create_consumers',
            'update_consumers',
            'update_users',
            'add_user',
            'edit_project',
            'delete_project',
            'delete_consumers',
            'delete_users',
        ],
        'consumers' => [
            'read',
            'check',
        ],
    ],
    'acl' => [
        'get' => [
            '~^\/api\/v1\/admin\/groups$~' => ['read'],
            '~^\/api\/v1\/admin\/groups\/(.+)$~' => ['read'],
            '~^\/api\/v1\/admin\/tables$~' => ['read'],
            '~^\/api\/v1\/admin\/tables\/(.+)$~' => ['read'],
            '~^\/api\/v1\/admin\/decisions$~' => ['read'],
            '~^\/api\/v1\/admin\/decisions\/(.+)$~' => ['read'],
            '~^\/api\/v1\/admin\/changelog\/tables\/(.+)$~' => ['read'],
            '~^\/api\/v1\/decisions\/(.+)$~' => ['read', 'check'],
            '~^\/api\/v1\/admin\/changelog\/(.+)$~' => ['read'],
            '~^\/api\/v1\/admin\/changelog\/(.+)\/(.+)$~' => ['read'],
            '~^\/api\/v1\/admin\/changelog\/(.+)\/(.+)\/diff$~' => ['read'],
            '~^\/api\/v1\/projects\/current$~' => ['read'],
            '~^\/api\/v1\/projects\/users$~' => ['read'],
        ],
        'post' => [
            '~^\/api\/v1\/admin\/groups$~' => ['read', 'create'],
            '~^\/api\/v1\/admin\/groups\/(.+)\/copy$~' => ['read', 'create'],
            '~^\/api\/v1\/admin\/tables$~' => ['read', 'create'],
            '~^\/api\/v1\/admin\/tables\/(.+)\/copy$~' => ['read', 'create'],
            '~^\/api\/v1\/admin\/changelog\/(.+)\/(.+)\/rollback\/(.+)$~' => ['read', 'update'],
            '~^\/api\/v1\/tables\/(.+)\/decisions$~' => ['read', 'check'],
            '~^\/api\/v1\/groups\/(.+)\/decisions$~' => ['read', 'check'],
            '~^\/api\/v1\/projects\/users$~' => ['read', 'create', 'add_user'],
            '~^\/api\/v1\/projects\/consumers~' => ['read', 'update', 'create_consumers'],
        ],
        'put' => [
            '~^\/api\/v1\/admin\/groups\/(.+)$~' => ['read', 'update'],
            '~^\/api\/v1\/admin\/tables\/(.+)$~' => ['read', 'update'],
            '~^\/api\/v1\/projects\/(.+)$~' => ['read', 'update', 'edit_project'],
            '~^\/api\/v1\/projects\/consumers~' => ['read', 'update', 'update_consumers'],
            '~^\/api\/v1\/projects\/users$~' => ['read', 'update', 'update_users'],
        ],
        'delete' => [
            '~^\/api\/v1\/admin\/groups\/(.+)$~' => ['read', 'delete'],
            '~^\/api\/v1\/projects\/(.+)$~' => ['read', 'delete_project'],
            '~^\/api\/v1\/admin\/tables\/(.+)$~' => ['read', 'delete'],
            '~^\/api\/v1\/projects\/consumers~' => ['read', 'update', 'delete_consumers'],
            '~^\/api\/v1\/projects\/users$~' => ['read', 'update', 'delete_users'],
        ],
    ],
];
