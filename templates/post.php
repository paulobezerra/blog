<?php $post = $page['post']; ?>
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
        <div><h2>Procurando uma hospedagem para seu projeto?</h2>
            <p>Veja opções HostGator para publicar um site e confira requisitos, compatibilidade e manutenção antes de contratar.</p></div>
        <a class="button-link" href="/melhores-hospedagens#sites">Ver opções HostGator para sites</a></aside>
</article>
