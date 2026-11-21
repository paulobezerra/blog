<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;

/** @param array<string, mixed> $page */
function renderPage(ResponseInterface $response, array $page, string $canonicalPath): ResponseInterface
{
    $page['canonical'] = SITE_URL . $canonicalPath;
    ob_start();
    require dirname(__DIR__) . '/templates/layout.php';
    $html = ob_get_clean();
    $response->getBody()->write($html === false ? '' : $html);
    return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
}

/** @return array<string, string> */
function notFoundPage(): array
{
    return ['type' => '404', 'title' => 'Página não encontrada | ' . SITE_NAME, 'description' => 'O conteúdo solicitado não foi encontrado.'];
}
