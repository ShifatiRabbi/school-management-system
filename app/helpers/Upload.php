<?php

declare(strict_types=1);

namespace App\Helpers;

final class Upload
{
    /**
     * Securely store an uploaded file.
     *
     * @param array $file $_FILES element
     * @param string $destinationDir Absolute or project-relative path ending with /
     * @param array $allowedExt
     * @param array $allowedMime
     * @param int $maxBytes
     * @return array{ok:bool,path?:string,filename?:string,error?:string}
     */
    public static function store(
        array $file,
        string $destinationDir,
        array $allowedExt,
        array $allowedMime,
        int $maxBytes
    ): array {
        if (!isset($file['error']) || is_array($file['error'])) {
            return ['ok' => false, 'error' => 'Invalid upload parameters'];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['ok' => false, 'error' => self::errorMessage((int)$file['error'])];
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            return ['ok' => false, 'error' => 'Invalid uploaded file'];
        }

        if ((int)$file['size'] <= 0 || (int)$file['size'] > $maxBytes) {
            return ['ok' => false, 'error' => 'File size is invalid or exceeds the limit'];
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($ext === '' || !in_array($ext, $allowedExt, true)) {
            return ['ok' => false, 'error' => 'File type not allowed'];
        }

        // Block double extensions like file.php.jpg by checking basename for dangerous patterns
        $base = strtolower(basename($file['name']));
        if (preg_match('/\.(php|phtml|phar|cgi|pl|asp|aspx|js|exe|sh|bat|cmd)(\.|$)/i', $base)) {
            // Allow only if the single real extension is in allowlist and not executable
            if (in_array($ext, ['php', 'phtml', 'phar', 'cgi', 'pl', 'asp', 'aspx', 'exe', 'sh', 'bat', 'cmd'], true)) {
                return ['ok' => false, 'error' => 'Executable uploads are not allowed'];
            }
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']) ?: '';
        if ($mime === '' || !in_array($mime, $allowedMime, true)) {
            return ['ok' => false, 'error' => 'Invalid file content type'];
        }

        // Extra image validation
        if (str_starts_with($mime, 'image/') && $mime !== 'image/svg+xml') {
            $imageInfo = @getimagesize($file['tmp_name']);
            if ($imageInfo === false) {
                return ['ok' => false, 'error' => 'Invalid image file'];
            }
        }

        if (!is_dir($destinationDir)) {
            if (!mkdir($destinationDir, 0755, true) && !is_dir($destinationDir)) {
                return ['ok' => false, 'error' => 'Failed to create upload directory'];
            }
        }

        $newName = bin2hex(random_bytes(16)) . '.' . $ext;
        $target = rtrim($destinationDir, '/\\') . DIRECTORY_SEPARATOR . $newName;

        if (!move_uploaded_file($file['tmp_name'], $target)) {
            return ['ok' => false, 'error' => 'Failed to save uploaded file'];
        }

        @chmod($target, 0644);

        return [
            'ok'       => true,
            'filename' => $newName,
            'path'     => $target,
        ];
    }

    private static function errorMessage(int $code): string
    {
        return match ($code) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'File is too large',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'Upload blocked by extension',
            default => 'Upload failed',
        };
    }
}
