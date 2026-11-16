<?php $heading = ($cardHeading ?? 'h2') === 'h3' ? 'h3' : 'h2'; ?>
<?php if (!$featured): ?>
    <p class="empty-state">Novos artigos em breve.</p>
<?php else: ?>
    <div class="post-grid">
    <?php foreach ($featured as $item): ?>
        <article class="post-card">
            <div class="card-body">
                <div class="meta">
                    <?php if ($item['category']): ?>
                        <span><?= e($item['category']) ?></span><span class="dot">·</span>
                    <?php endif; ?>
                    <time datetime="<?= e($item['date']) ?>"><?= e(date('d/m/y', strtotime($item['date']))) ?></time>
                </div>
                <<?= $heading ?>><a href="/blog/<?= e($item['slug']) ?>"><?= e($item['title']) ?></a></<?= $heading ?>>
            <p><?= e($item['description']) ?></p>
            <a class="read-more" href="/blog/<?= e($item['slug']) ?>">Ler artigo <span aria-hidden="true">↗</span></a>
        </div>
        </article>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
