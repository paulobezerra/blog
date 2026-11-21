<?php
$catalog = $page['providers'];
$links = hostingAffiliateLinks();
$categoryNames = ['sites'=>'Sites e blogs','infraestrutura'=>'Infraestrutura e revenda','automacao'=>'Automação e IA','outras'=>'Outras soluções'];
?>
<section class="hosting-page">
  <header class="hosting-hero"><div class="hosting-wrap">
    <p class="eyebrow">GUIA DE SERVIÇOS HOSTGATOR</p><h1>Compare serviços HostGator para o seu projeto</h1>
    <p class="hosting-lead">Esta página compara 13 serviços HostGator por finalidade, perfil indicado e cuidados antes da contratação. A seleção é comercial e não representa uma comparação de todos os fornecedores do mercado.</p>
    <nav class="hosting-jump" aria-label="Ir para uma categoria"><a href="#quiz">Fazer o quiz ↓</a><?php foreach ($categoryNames as $id=>$name): ?><a href="#<?= e($id) ?>"><?= e($name) ?> ↓</a><?php endforeach; ?></nav>
    <aside class="hosting-disclosure"><strong>Transparência:</strong> esta seleção cobre apenas serviços HostGator e pode gerar comissão se você contratar pelos links. Consulte as condições e a compatibilidade diretamente com o fornecedor. A exclusividade HostGator é uma regra comercial informada pelo proprietário deste site, não uma política geral do Google Ads.</aside>
  </div></header>
  <div class="hosting-wrap hosting-body">
    <?php require __DIR__ . '/hosting-wizard.php'; ?>
    <section class="editorial-method"><strong>Como usar este comparativo</strong><p>Os serviços têm finalidades diferentes e não são substitutos diretos. As descrições evitam presumir recursos ou preços não confirmados; confira os detalhes atuais, valor total, renovação, suporte e responsabilidades na página comercial.</p><small>A indicação do quiz é apenas um ponto de partida. Confirme requisitos e compatibilidade antes de contratar.</small></section>
    <?php foreach ($catalog as $category=>$providers): ?><section class="hosting-category" id="<?= e($category) ?>">
      <div class="hosting-section-heading"><p class="eyebrow">CATÁLOGO</p><h2><?= e($categoryNames[$category]) ?></h2><p>Finalidade, perfil indicado e cuidados para cada serviço.</p></div>
      <div class="provider-list">
      <?php foreach ($providers as $i=>$p): ?><article class="provider-card" id="service-<?= e($p['slug']) ?>" tabindex="-1">
        <header class="provider-head"><span class="provider-rank"><?= $i+1 ?></span><div class="provider-logo"><?= e($p['name']) ?></div><span class="recommendation-badge" hidden>Recomendado para suas respostas</span></header>
        <div class="provider-content"><div class="provider-main"><h3><?= e($p['name']) ?></h3><p><?= e($p['description']) ?></p><p class="provider-profile"><strong>Indicado para:</strong> <?= e($p['profile']) ?></p></div><div class="provider-offer"><span class="offer-label">Condições comerciais</span><strong>Consulte as condições</strong><p>Preço, recursos, elegibilidade e renovação podem variar. Confira a oferta vigente.</p><a class="button-link provider-button" href="<?= e($links[$p['slug']]) ?>" target="_blank" rel="sponsored nofollow noopener">Ver <?= e($p['name']) ?> ↗</a></div></div>
        <div class="provider-details"><div><h4>Finalidade</h4><p><?= e($p['purpose']) ?></p></div><div><h4>Cuidados antes de contratar</h4><p><?= e($p['care']) ?></p></div></div>
      </article><?php endforeach; ?>
      </div>
    </section><?php endforeach; ?>
    <section class="hosting-faq"><h2>Antes de contratar</h2><ol><li>Confirme que o serviço atende ao seu objetivo e aos requisitos do projeto.</li><li>Verifique valor total, duração do ciclo, renovação e itens cobrados à parte.</li><li>Entenda limites, suporte, backups, segurança e responsabilidades de administração.</li><li>Para servidores, identifique quem fará instalação, atualizações, monitoramento e resposta a incidentes.</li></ol><p>Não sabe por onde começar? Use o quiz como orientação inicial e confirme a compatibilidade com a HostGator.</p></section>
  </div>
</section>
