<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return static function (App $app, Posts $posts): void {
    $home = static function (ServerRequestInterface $request, ResponseInterface $response) use ($posts): ResponseInterface {
        return renderPage($response, [
            'type' => 'home',
            'title' => 'Domínio, hospedagem e tecnologia | ' . SITE_NAME,
            'description' => 'Explicações sobre domínio, hospedagem e os cuidados para colocar um projeto na web.',
            'posts' => $posts->all(),
        ], '/');
    };
    $app->get('/', $home);
    $app->get('/index.php', $home);

    $app->get('/blog', static function (ServerRequestInterface $request, ResponseInterface $response) use ($posts): ResponseInterface {
        $items = $posts->all();
        $query = $request->getQueryParams();
        $pageNumber = filter_var($query['page'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 1;
        return renderPage($response, [
            'type' => 'blog',
            'title' => 'Blog | ' . SITE_NAME,
            'description' => 'Artigos sobre tecnologia, desenvolvimento, hospedagem e ferramentas digitais.',
            'pageNumber' => $pageNumber,
            'pageCount' => max(1, (int) ceil(count($items) / 10)),
            'posts' => array_slice($items, ($pageNumber - 1) * 10, 10),
        ], '/blog');
    });

    $app->get('/blog/{slug}', static function (ServerRequestInterface $request, ResponseInterface $response, array $args) use ($posts): ResponseInterface {
        $slug = (string) $args['slug'];
        $post = $posts->find($slug);
        if ($post === null || !$post['published']) {
            return renderPage($response->withStatus(404), notFoundPage(), '/blog/' . rawurlencode($slug));
        }
        return renderPage($response, [
            'type' => 'post',
            'title' => $post['title'] . ' | ' . SITE_NAME,
            'description' => $post['description'],
            'post' => $post,
            'posts' => [],
        ], '/blog/' . rawurlencode($post['slug']));
    });

    $app->get('/melhores-hospedagens', static function (ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        require_once __DIR__ . '/HostingProviders.php';
        return renderPage($response, [
            'type' => 'hosting',
            'title' => 'Compare serviços HostGator para seu projeto | ' . SITE_NAME,
            'description' => 'Entenda qual serviço HostGator faz sentido para seu projeto e confira cuidados com requisitos, cobrança e renovação antes de contratar.',
            'providers' => hostingProviders(),
            'posts' => [],
        ], '/melhores-hospedagens');
    });

    $app->get('/escolher-hospedagem', static fn(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface =>
        $response->withHeader('Location', '/melhores-hospedagens#quiz')->withStatus(301));

    $editorialPages = [
        'sobre' => ['Sobre', 'Conheça Paulo Bezerra e o propósito deste blog.'],
        'contato' => ['Contato', 'Como entrar em contato com Paulo Bezerra.'],
        'privacidade' => ['Privacidade', 'Informações sobre privacidade e uso de dados neste site.'],
    ];
    foreach ($editorialPages as $path => [$title, $description]) {
        $app->get('/' . $path, static fn(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface =>
            renderPage($response, [
                'type' => $path,
                'title' => $title . ' | ' . SITE_NAME,
                'description' => $description,
                'posts' => [],
            ], '/' . $path));
    }

    $sitemap = static function (ServerRequestInterface $request, ResponseInterface $response) use ($posts): ResponseInterface {
        $urls = [SITE_URL . '/', SITE_URL . '/blog', SITE_URL . '/sobre', SITE_URL . '/contato', SITE_URL . '/privacidade', SITE_URL . '/melhores-hospedagens'];
        foreach ($posts->all() as $post) {
            $urls[] = SITE_URL . '/blog/' . rawurlencode($post['slug']);
        }
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        foreach ($urls as $url) {
            $xml .= '  <url><loc>' . htmlspecialchars($url, ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</loc></url>\n";
        }
        $xml .= "</urlset>\n";
        $response->getBody()->write($xml);
        return $response->withHeader('Content-Type', 'application/xml; charset=utf-8');
    };
    $app->get('/sitemap.xml', $sitemap);
    $app->get('/sitemap', $sitemap);
};
