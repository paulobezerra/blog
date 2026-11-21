<?php
declare(strict_types=1);

if (PHP_SAPI === 'cli-server') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $requestedFile = is_string($requestPath) ? realpath(__DIR__ . rawurldecode($requestPath)) : false;
    $publicRoot = realpath(__DIR__);
    if ($requestedFile !== false && $publicRoot !== false
        && str_starts_with($requestedFile, $publicRoot . DIRECTORY_SEPARATOR)
        && is_file($requestedFile)) {
        return false;
    }
}

$projectRoot = dirname(__DIR__);
require $projectRoot . '/vendor/autoload.php';
require $projectRoot . '/src/Posts.php';

const SITE_NAME = 'Paulo Bezerra';
const SITE_URL = 'https://paulobezerra.eti.br';
$analyticsId = getenv('GA4_MEASUREMENT_ID') ?: '';
$analyticsId = preg_match('/\AG-[A-Z0-9]+\z/', $analyticsId) ? $analyticsId : '';
$posts = new Posts($projectRoot . '/content/posts');
$route = trim((string)($_GET['route'] ?? parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH)), '/');
$page = ['type' => 'home', 'title' => SITE_NAME, 'description' => 'Tecnologia, desenvolvimento de software e ferramentas digitais, com ideias práticas para a web.'];
$items = $posts->all();
$status = 200;

if ($route === 'sitemap') {
    header('Content-Type: application/xml; charset=utf-8');
    $urls = [SITE_URL . '/', SITE_URL . '/blog', SITE_URL . '/sobre', SITE_URL . '/contato', SITE_URL . '/privacidade', SITE_URL . '/melhores-hospedagens'];
    foreach ($items as $post) $urls[] = SITE_URL . '/blog/' . rawurlencode($post['slug']);
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach ($urls as $url) echo '  <url><loc>' . htmlspecialchars($url, ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</loc></url>\n";
    echo "</urlset>\n";
    exit;
}
if ($route === '' || $route === 'index.php') {
    $page['type'] = 'home';
} elseif ($route === 'blog') {
    $page = ['type' => 'blog', 'title' => 'Blog | ' . SITE_NAME, 'description' => 'Artigos sobre tecnologia, desenvolvimento, hospedagem e ferramentas digitais.'];
} elseif ($route === 'escolher-hospedagem') {
    header('Location: /melhores-hospedagens#quiz', true, 301);
    exit;
} elseif ($route === 'melhores-hospedagens') {
    require $projectRoot . '/src/HostingProviders.php';
    $page = ['type' => 'hosting', 'title' => 'Compare serviços HostGator para seu projeto | ' . SITE_NAME, 'description' => 'Compare 13 serviços HostGator por finalidade, perfil indicado e cuidados antes de contratar. Use o quiz para encontrar uma opção para avaliar.', 'providers' => hostingProviders()];
} elseif (preg_match('~^blog/(.*)$~', $route, $match)) {
    $post = $posts->find($match[1]);
    if ($post === null || !$post['published']) {
        $status = 404;
        $page = ['type' => '404', 'title' => 'Página não encontrada | ' . SITE_NAME, 'description' => 'O conteúdo solicitado não foi encontrado.'];
    } else $page = ['type' => 'post', 'title' => $post['title'] . ' | ' . SITE_NAME, 'description' => $post['description'], 'post' => $post];
} elseif (in_array($route, ['sobre', 'contato', 'privacidade'], true)) {
    $titles = ['sobre' => 'Sobre', 'contato' => 'Contato', 'privacidade' => 'Privacidade'];
    $descriptions = ['sobre' => 'Conheça Paulo Bezerra e o propósito deste blog.', 'contato' => 'Como entrar em contato com Paulo Bezerra.', 'privacidade' => 'Informações sobre privacidade e uso de dados neste site.'];
    $page = ['type' => $route, 'title' => $titles[$route] . ' | ' . SITE_NAME, 'description' => $descriptions[$route]];
} else {
    $status = 404;
    $page = ['type' => '404', 'title' => 'Página não encontrada | ' . SITE_NAME, 'description' => 'O conteúdo solicitado não foi encontrado.'];
}
http_response_code($status);
$canonicalPath = $route === '' || $route === 'index.php' ? '/' : '/' . $route;
$canonical = SITE_URL . $canonicalPath;
$page['canonical'] = $canonical;
if ($page['type'] === 'blog') {
    $perPage = 10;
    $pageNumber = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 1;
    $page['pageNumber'] = $pageNumber;
    $page['pageCount'] = max(1, (int)ceil(count($items) / $perPage));
    $page['posts'] = array_slice($items, ($pageNumber - 1) * $perPage, $perPage);
} else {
    $page['posts'] = $items;
}
require $projectRoot . '/templates/layout.php';
