<?php if (!$featured): ?><p class="empty-state">Novos artigos em breve.</p><?php else: ?><div class="post-grid">
<?php foreach ($featured as $item): ?><article class="post-card">
<a class="card-image" href="/blog/<?= e($item['slug']) ?>" aria-label="Ler: <?= e($item['title']) ?>">
<?php if ($item['cover']): ?><img src="<?= e($item['cover']) ?>" alt="" loading="lazy" width="720" height="430"><?php else: ?><div class="image-placeholder" aria-hidden="true"><span>PB.</span></div><?php endif; ?>
</a><div class="card-body"><div class="meta"><?php if ($item['category']): ?><span><?= e($item['category']) ?></span><span class="dot">·</span><?php endif; ?><time datetime="<?= e($item['date']) ?>"><?= e(date('d.m.Y', strtotime($item['date']))) ?></time></div><h2><a href="/blog/<?= e($item['slug']) ?>"><?= e($item['title']) ?></a></h2><p><?= e($item['description']) ?></p><a class="read-more" href="/blog/<?= e($item['slug']) ?>">Ler artigo <span aria-hidden="true">↗</span></a></div></article><?php endforeach; ?>
</div><?php endif; ?>
