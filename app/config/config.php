<?php
/**
 * Application configuration.
 * Prefer environment variables; falls back to local defaults for development.
 * Copy config.example.php values into a non-web-accessible .env when deploying.
 */

declare(strict_types=1);

return [
    'app_name'    => getenv('SMS_APP_NAME') ?: 'School Management System',
    'app_env'     => getenv('SMS_APP_ENV') ?: 'production',
    'app_debug'   => filter_var(getenv('SMS_APP_DEBUG') ?: '0', FILTER_VALIDATE_BOOLEAN),
    'app_url'     => rtrim(getenv('SMS_APP_URL') ?: '', '/'),
    'timezone'    => getenv('SMS_TIMEZONE') ?: 'Asia/Dhaka',

    'db' => [
        'host'    => getenv('SMS_DB_HOST') ?: 'localhost',
        'name'    => getenv('SMS_DB_NAME') ?: 'spahhse1_sms',
        'user'    => getenv('SMS_DB_USER') ?: 'spahhse1_admin',
        'pass'    => getenv('SMS_DB_PASS') !== false && getenv('SMS_DB_PASS') !== ''
            ? getenv('SMS_DB_PASS')
            : '*121*spahhs@Shifat#',
        'charset' => 'utf8mb4',
    ],

    'session' => [
        'name'            => 'SMSSESSID',
        'lifetime'        => 7200, // 2 hours inactivity timeout
        'secure'          => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'httponly'        => true,
        'samesite'        => 'Lax',
        'use_strict_mode' => true,
    ],

    'upload' => [
        'max_image_bytes' => 15 * 1024 * 1024,
        'max_video_bytes' => 500 * 1024 * 1024,
        'max_doc_bytes'   => 10 * 1024 * 1024,
        'image_ext'       => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
        'video_ext'       => ['mp4', 'webm', 'mov'],
        'doc_ext'         => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv'],
        'image_mime'      => ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
        'video_mime'      => ['video/mp4', 'video/webm', 'video/quicktime'],
        'doc_mime'        => [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/csv',
            'text/plain',
            'application/csv',
        ],
    ],

    'security' => [
        'login_max_attempts' => 8,
        'login_lockout_sec'  => 900,
    ],
];
