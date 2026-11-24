<?php $post = $page['post'];
require_once dirname(__DIR__) . '/src/HostingProviders.php';
$ctaService = $post['cta_service'] !== '' ? hostingProvider($post['cta_service']) : null;
$ctaCopy = [
    'sites' => ['Procurando uma hospedagem para seu site?', 'Compare as opções HostGator para publicar um site e confira requisitos, compatibilidade e manutenção antes de contratar.'],
    'infraestrutura' => ['Precisa de mais controle sobre o servidor?', 'Veja o que o serviço inclui e confira recursos, administração, segurança e custo total antes de contratar.'],
    'automacao' => ['Quer rodar suas automações em um servidor?', 'Confira o que está incluído e quem cuida da manutenção, da segurança e dos backups antes de contratar.'],
    'outras' => ['Quer avaliar esta solução para seu projeto?', 'Veja para quem o serviço é indicado e confira requisitos, recursos e condições antes de contratar.'],
];
[$ctaTitle, $ctaText, $ctaLabel, $ctaHref] = $ctaService !== null && isset($ctaCopy[$ctaService['category']])
    ? [...$ctaCopy[$ctaService['category']], 'Ver ' . $ctaService['name'], '/melhores-hospedagens#service-' . $ctaService['slug']]
    : ['Procurando uma hospedagem para seu projeto?', 'Veja opções HostGator para publicar um site e confira requisitos, compatibilidade e manutenção antes de contratar.', 'Ver opções HostGator para sites', '/melhores-hospedagens#sites']; ?>
<article class="article-wrap wrap">
    <header class="article-header"><a class="back-link" href="/blog">← Todos os artigos</a>
        <div class="meta article-meta"><?php if ($post['category']): ?><span><?= e($post['category']) ?></span><span
                    class="dot">·</span><?php endif; ?>
            <time datetime="<?= e($post['date']) ?>"><?= e(date('d.m.Y', strtotime($post['date']))) ?></time>
        </div>
        <h1><?= e($post['title']) ?></h1>
        <p class="article-deck"><?= e($post['description']) ?></p></header>
    <?php if ($post['cover']): ?><img class="article-cover" src="<?= e($post['cover']) ?>" alt=""
                                      fetchpriority="high"><?php endif; ?>
    <div class="prose"><?php if ($post['affiliate']): ?>
            <aside class="affiliate-note"><strong>Transparência:</strong> este artigo pode conter links de afiliados. Se
                você contratar por eles, o site pode receber uma comissão, sem custo adicional para você. As
                recomendações devem ser avaliadas conforme suas necessidades.
            </aside><?php endif; ?><?= $post['content'] ?></div>
    <aside class="article-hosting-cta">
        <div><h2><?= e($ctaTitle) ?></h2>
            <p><?= e($ctaText) ?></p></div>
        <a class="button-link" href="<?= e($ctaHref) ?>"><?= e($ctaLabel) ?></a></aside>
</article>
