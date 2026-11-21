<section class="page-intro wrap"><p class="eyebrow">ARTIGOS</p>
    <h1>Artigos</h1>
    <p>Programação, infraestrutura e ferramentas que fazem parte do meu trabalho. Explicações e comparações para
        entender as opções e decidir o próximo passo do seu projeto.</p></section>
<section class="section wrap"><?php $featured = $page['posts'];
    require __DIR__ . '/post-list.php'; ?></section>
<?php if ($page['pageCount'] > 1): ?>
    <nav class="pagination wrap" aria-label="Paginação">
    <?php if ($page['pageNumber'] > 1): ?><a href="/blog?page=<?= $page['pageNumber'] - 1 ?>">← Mais
        recentes</a><?php endif; ?><span>Página <?= $page['pageNumber'] ?>
    de <?= $page['pageCount'] ?></span><?php if ($page['pageNumber'] < $page['pageCount']): ?><a
        href="/blog?page=<?= $page['pageNumber'] + 1 ?>">Mais antigos →</a><?php endif; ?>
    </nav><?php endif; ?>

<div class="wrap blog-cta">
    <aside class="article-hosting-cta">
        <div><h2>Seu próximo projeto começa com uma boa escolha de hospedagem.</h2>
            <p>Vai publicar um site? Veja opções HostGator e confira requisitos e condições antes de contratar.</p></div>
        <a class="button-link" href="/melhores-hospedagens#sites">Ver opções HostGator para sites</a></aside>
</div>
