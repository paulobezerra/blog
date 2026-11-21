<?php
$latest = $page['posts'][0] ?? null;
$recentPosts = array_slice($page['posts'], 1, 4);
?>
<div class="home-page">
  <div class="home-layout wrap">
    <section class="home-hero" aria-labelledby="home-title">
      <p class="home-kicker">PAULO BEZERRA / BLOG PESSOAL</p>
      <h1 id="home-title">Domínio, hospedagem<br>e tecnologia<span>.</span></h1>
      <p class="home-intro">Sou desenvolvedor e Tech Lead. Aqui compartilho explicações sobre domínio, hospedagem e os cuidados para colocar um projeto na web.</p>
      <a class="text-link" href="/sobre">Um pouco sobre mim <span aria-hidden="true">↗</span></a>
      <ul class="home-topics" aria-label="Assuntos do blog"><li>Desenvolvimento</li><li>Backend</li><li>Infraestrutura</li><li>Dicas práticas</li></ul>
    </section>

    <div class="home-editorial">
      <div class="home-feed">
        <section aria-labelledby="latest-title">
          <p class="home-section-label" id="latest-title">NO BLOG / ÚLTIMA PUBLICAÇÃO</p>
          <?php if ($latest): ?>
            <article class="home-feature">
              <div class="home-feature-meta">
                <?php if ($latest['category']): ?><span><?= e($latest['category']) ?></span><?php endif; ?>
                <time datetime="<?= e($latest['date']) ?>"><?= e(date('d/m/Y', strtotime($latest['date']))) ?></time>
              </div>
              <h2><a href="/blog/<?= e($latest['slug']) ?>"><?= e($latest['title']) ?></a></h2>
              <p><?= e($latest['description']) ?></p>
              <a class="text-link" href="/blog/<?= e($latest['slug']) ?>">Ler artigo <span aria-hidden="true">→</span></a>
            </article>
          <?php else: ?>
            <p class="empty-state">Estou preparando os primeiros artigos. Volte em breve para acompanhar.</p>
          <?php endif; ?>
        </section>

        <?php if ($recentPosts): ?>
          <section class="home-recent" aria-labelledby="recent-title">
            <div class="home-section-heading"><h2 id="recent-title">Mais do blog</h2><a href="/blog">VER TODOS <span aria-hidden="true">→</span></a></div>
            <div class="home-reading-list">
              <?php foreach ($recentPosts as $item): ?>
                <article class="home-entry">
                  <div class="home-entry-meta"><time datetime="<?= e($item['date']) ?>"><?= e(date('d/m/Y', strtotime($item['date']))) ?></time><?php if ($item['category']): ?><span><?= e($item['category']) ?></span><?php endif; ?></div>
                  <h3><a href="/blog/<?= e($item['slug']) ?>"><?= e($item['title']) ?></a></h3>
                  <p><?= e($item['description']) ?></p>
                  <a class="home-post-link" href="/blog/<?= e($item['slug']) ?>">LER ARTIGO <span aria-hidden="true">↗</span></a>
                </article>
              <?php endforeach; ?>
            </div>
          </section>
        <?php endif; ?>
        <a class="home-archive" href="/blog">Explorar todos os artigos <span aria-hidden="true">→</span></a>
      </div>

      <aside class="home-sidebar" aria-label="Sobre o autor e guia de hospedagem">
        <section class="home-author" aria-labelledby="author-title">
          <div class="home-monogram" aria-hidden="true">pb<span>_</span></div>
          <p class="home-section-label">QUEM ESCREVE</p>
          <h2 id="author-title">Olá, sou o Paulo.</h2>
          <p>Desenvolvedor desde 2008, hoje Tech Lead. Minha experiência passa por Java, backend e os desafios de manter sistemas funcionando.</p>
          <p>Gosto de entender o que acontece por trás das ferramentas e compartilhar o que aprendo.</p>
          <a class="text-link" href="/sobre">Conheça minha trajetória <span aria-hidden="true">↗</span></a>
        </section>
        <section class="home-guide" aria-labelledby="guide-title">
          <p class="home-section-label">GUIA PARA CONSULTAR</p>
          <h2 id="guide-title">Vai colocar um projeto no ar?</h2>
          <p>Escolha entre hospedagem de sites, WordPress e criador de sites, e confira os cuidados antes de contratar.</p>
          <a class="text-link" href="/melhores-hospedagens#sites">Ver opções HostGator para sites <span aria-hidden="true">→</span></a>
        </section>
        <p class="home-contact">Tem uma dúvida ou sugestão de assunto? <a href="/contato">Vamos conversar ↗</a></p>
      </aside>
    </div>
  </div>
</div>
