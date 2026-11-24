<?php
$providers = $page['providers'];
$links = hostingAffiliateLinks();
?>
<section class="hosting-page hosting-sites-page">
  <header class="hosting-hero hosting-sites-hero"><div class="hosting-wrap">
    <h1>Hospedagem de sites na HostGator</h1>
    <p class="hosting-lead">Três opções para colocar seu site ou blog no ar. Escolha a que combina com o seu projeto.</p>
    <p class="hosting-sites-disclosure">Links de afiliado: posso receber comissão se você contratar, sem custo extra.</p>
  </div></header>
  <div class="hosting-wrap hosting-body hosting-sites-body">
    <div class="provider-list">
    <?php foreach ($providers as $p): ?><article class="provider-card" id="service-<?= e($p['slug']) ?>">
      <div class="provider-main"><h2 class="hosting-sites-name"><?= e($p['name']) ?></h2><p class="provider-profile"><strong>Indicado para:</strong> <?= e($p['profile']) ?></p></div>
      <a class="button-link provider-button" href="<?= e($links[$p['slug']]) ?>" target="_blank" rel="sponsored nofollow noopener">Ver planos na HostGator ↗</a>
      <details class="hosting-sites-details"><summary>Ver cuidados antes de contratar</summary>
        <div class="provider-details"><div><h4>Finalidade</h4><p><?= e($p['purpose']) ?></p></div><div><h4>Cuidados antes de contratar</h4><p><?= e($p['care']) ?></p></div></div>
      </details>
    </article><?php endforeach; ?>
    </div>
    <p class="hosting-sites-more"><a class="text-link" href="/melhores-hospedagens">Ver todos os serviços</a></p>
  </div>
</section>
