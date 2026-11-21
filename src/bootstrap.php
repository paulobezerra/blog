<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/Posts.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/render.php';

const SITE_NAME = 'Paulo Bezerra';
const SITE_URL = 'https://blog.paulobezerra.eti.br';

$posts = new Posts(dirname(__DIR__) . '/content/posts');
$app = AppFactory::create();
$registerRoutes = require __DIR__ . '/routes.php';
$registerRoutes($app, $posts);

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(getenv('APP_ENV') !== 'production', true, true);
$responseFactory = $app->getResponseFactory();
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, static function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($responseFactory): ResponseInterface {
    return renderPage($responseFactory->createResponse(404), notFoundPage(), '/');
});

// Traduz aliases antigos e remove barras finais antes da resolução das rotas.
$app->add(static function (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $path = $request->getUri()->getPath();
    $legacyRoute = $request->getQueryParams()['route'] ?? null;
    if (is_string($legacyRoute) && $legacyRoute !== '') {
        $legacyRoute = trim($legacyRoute, '/');
        $path = $legacyRoute === 'sitemap' ? '/sitemap.xml' : '/' . $legacyRoute;
    }
    $path = rtrim($path, '/') ?: '/';
    return $handler->handle($request->withUri($request->getUri()->withPath($path)));
});

return $app;
