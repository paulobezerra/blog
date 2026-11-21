<?php
declare(strict_types=1);

/** Identifica arquivos que o servidor embutido pode atender diretamente. */
function isPublicFile(string $publicDirectory, string $requestUri): bool
{
    $path = parse_url($requestUri, PHP_URL_PATH);
    $root = realpath($publicDirectory);
    if (!is_string($path) || $root === false) {
        return false;
    }

    $file = realpath($root . '/' . ltrim(rawurldecode($path), '/'));

    return $file !== false
        && str_starts_with($file, $root . DIRECTORY_SEPARATOR)
        && is_file($file);
}
