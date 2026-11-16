<?php
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
$title = (string)$page['title']; $description = (string)$page['description'];
$shareImage = $page['type'] === 'post' && $page['post']['cover'] !== '' ? SITE_URL . $page['post']['cover'] : SITE_URL . '/assets/images/og-cover.svg';
?><!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?></title><meta name="description" content="<?= e($description) ?>">
  <link rel="canonical" href="<?= e($page['canonical']) ?>">
  <meta property="og:type" content="<?= $page['type'] === 'post' ? 'article' : 'website' ?>"><meta property="og:site_name" content="<?= e(SITE_NAME) ?>"><meta property="og:title" content="<?= e($title) ?>"><meta property="og:description" content="<?= e($description) ?>"><meta property="og:url" content="<?= e($page['canonical']) ?>"><meta property="og:image" content="<?= e($shareImage) ?>">
  <meta name="twitter:card" content="summary_large_image"><meta name="twitter:title" content="<?= e($title) ?>"><meta name="twitter:description" content="<?= e($description) ?>"><meta name="twitter:image" content="<?= e($shareImage) ?>">
  <link rel="stylesheet" href="/assets/css/style.css"><script src="/assets/js/main.js" defer></script>
<?php if ($page['type'] === 'post'): $p = $page['post']; ?>
  <script type="application/ld+json"><?= json_encode(['@context'=>'https://schema.org','@type'=>'BlogPosting','headline'=>$p['title'],'description'=>$p['description'],'datePublished'=>$p['date'],'mainEntityOfPage'=>$page['canonical'],'author'=>['@type'=>'Person','name'=>SITE_NAME],'image'=>$shareImage], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
<?php endif; ?>
</head>
<body>
<header class="site-header"><div class="wrap nav-wrap"><a class="brand" href="/">Paulo Bezerra<span>.</span></a><button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav">Menu</button><nav id="main-nav" aria-label="Navegação principal"><a href="/">Início</a><a href="/blog">Blog</a><a href="/sobre">Sobre</a></nav></div></header>
<main>
<?php require __DIR__ . '/' . match ($page['type']) { 'home'=>'templates/home.php', 'blog'=>'templates/blog.php', 'post'=>'templates/post.php', 'sobre'=>'templates/sobre.php', 'contato'=>'templates/contato.php', 'privacidade'=>'templates/privacidade.php', default=>'templates/404.php' }; ?>
</main>
<footer class="site-footer"><div class="wrap footer-inner"><span>© <?= date('Y') ?> Paulo Bezerra</span><nav aria-label="Links do rodapé"><a href="/contato">Contato</a><a href="/privacidade">Privacidade</a></nav></div></footer>
</body></html>
