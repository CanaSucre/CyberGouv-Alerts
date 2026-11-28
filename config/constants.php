<?php

    const AUTHORIZED_DRIVERS = ['mysql', 'pgsql', 'sqlite'];
    const ALLOWED_APP_ENV = ['dev', 'prod'];

    // Variables qui doivent exister dans le .env pour chaque driver
    const DRIVER_REQUIRED_ENV_VARS = [
        'mysql' => ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_CHARSET'],
        'pgsql' => ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS'],
        'sqlite' => ['DB_NAME'],
    ];

    // Parmi les précédentes, celles qui ont le droit d'être vides
    const DRIVER_EMPTYABLE_ENV_VARS = [
        'mysql' => ['DB_PASS'],
        'pgsql' => ['DB_PASS'],
        'sqlite' => [],
    ];

    const DRIVER_DSN_TEMPLATES = [
        'mysql' => 'mysql:host={{DB_HOST}};port={{DB_PORT}};dbname={{DB_NAME}};charset={{DB_CHARSET}}',
        'pgsql' => 'pgsql:host={{DB_HOST}};port={{DB_PORT}};dbname={{DB_NAME}}',
        'sqlite' => 'sqlite:{{DB_NAME}}',
    ];


?>