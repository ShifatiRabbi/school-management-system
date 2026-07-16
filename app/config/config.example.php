<?php
/**
 * Example configuration — copy values to environment variables on the server:
 *
 * SMS_APP_NAME=School Management System
 * SMS_APP_ENV=production
 * SMS_APP_DEBUG=0
 * SMS_APP_URL=https://your-domain.example
 * SMS_TIMEZONE=Asia/Dhaka
 * SMS_DB_HOST=localhost
 * SMS_DB_NAME=your_database
 * SMS_DB_USER=your_user
 * SMS_DB_PASS=your_strong_password
 */

return [
    'app_name'  => 'School Management System',
    'app_env'   => 'production',
    'app_debug' => false,
    'app_url'   => 'https://your-domain.example',
    'timezone'  => 'Asia/Dhaka',
    'db' => [
        'host'    => 'localhost',
        'name'    => 'your_database',
        'user'    => 'your_user',
        'pass'    => 'your_strong_password',
        'charset' => 'utf8mb4',
    ],
];
