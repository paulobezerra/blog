<section class="page-intro wrap"><p class="eyebrow">ARTIGOS</p><h1>Blog</h1><p>Notas, guias e aprendizados sobre criar e manter uma presença útil na web.</p></section>
<section class="section wrap"><?php $featured = $page['posts']; require __DIR__ . '/post-list.php'; ?></section>
<?php if ($page['pageCount'] > 1): ?><nav class="pagination" aria-label="Paginação">
<?php if ($page['pageNumber'] > 1): ?><a href="/blog?page=<?= $page['pageNumber'] - 1 ?>">← Mais recentes</a><?php endif; ?><span>Página <?= $page['pageNumber'] ?> de <?= $page['pageCount'] ?></span><?php if ($page['pageNumber'] < $page['pageCount']): ?><a href="/blog?page=<?= $page['pageNumber'] + 1 ?>">Mais antigos →</a><?php endif; ?>
</nav><?php endif; ?>
