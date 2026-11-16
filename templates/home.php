<div class="home-page">
  <div class="home-layout wrap">
    <section class="home-hero" aria-labelledby="home-title">
      <div class="home-identity">
        <div>
          <p class="home-kicker">TECNOLOGIA · DESENVOLVIMENTO · WEB</p>
          <h1 id="home-title">PAULO<br>BEZERRA<span>.</span></h1>
        </div>
      </div>
      <nav class="home-nav" aria-label="Navegação principal">
        <a class="home-nav-active" href="/blog">&gt; ARTIGOS</a>
        <a href="/sobre">SOBRE</a>
        <a href="/contato">CONTATO</a>
      </nav>
      <p class="home-intro">Um espaço para aprender, testar ideias e compartilhar caminhos práticos para a web.</p>
    </section>

    <section class="home-recent" aria-labelledby="recent-title">
      <div class="home-section-heading">
        <div><p class="home-section-label">01 / PUBLICAÇÕES RECENTES</p><h2 id="recent-title">Notas do universo digital</h2></div>
        <a href="/blog">TODOS OS ARTIGOS <span aria-hidden="true">→</span></a>
      </div>
      <?php $featured = array_slice($page['posts'], 0, 3); ?>
      <?php if ($featured): ?>
        <div class="home-post-grid">
          <?php foreach ($featured as $item): ?>
            <article class="home-post-card">
              <div class="home-post-meta">
                <span class="home-post-category">#<?= e(strtoupper($item['category'] ?: 'ARTIGO')) ?></span>
                <time datetime="<?= e($item['date']) ?>"><?= e(date('d/m/y', strtotime($item['date']))) ?></time>
              </div>
              <h3><a href="/blog/<?= e($item['slug']) ?>"><?= e($item['title']) ?></a></h3>
              <p><?= e($item['description']) ?></p>
              <a class="home-post-link" href="/blog/<?= e($item['slug']) ?>">LER ARTIGO <span aria-hidden="true">↗</span></a>
            </article>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p class="home-empty">Novos artigos em breve.</p>
      <?php endif; ?>
    </section>
    <p class="home-status"><span><i></i> SITE ONLINE</span><span>FEITO COM PHP + MARKDOWN</span></p>
  </div>
</div>
