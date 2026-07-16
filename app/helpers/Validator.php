<?php

declare(strict_types=1);

namespace App\Helpers;

final class Validator
{
    public static function required(array $data, array $fields): array
    {
        $errors = [];
        foreach ($fields as $field) {
            if (!isset($data[$field]) || (is_string($data[$field]) && trim($data[$field]) === '')) {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
            }
        }
        return $errors;
    }

    public static function email(string $email): bool
    {
        return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function username(string $username): bool
    {
        return (bool)preg_match('/^[a-zA-Z0-9_.-]{3,50}$/', $username);
    }

    public static function intId($value): int
    {
        return max(0, (int)$value);
    }

    public static function sanitizeString(?string $value, int $maxLen = 500): string
    {
        $value = trim((string)$value);
        if (mb_strlen($value) > $maxLen) {
            $value = mb_substr($value, 0, $maxLen);
        }
        return $value;
    }
}
