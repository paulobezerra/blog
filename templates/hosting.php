<?php
$groups = $page['providers'];
$categoryNames = ['compartilhada'=>'hospedagem compartilhada','vps'=>'hospedagem VPS'];
$faq = [
    ['q'=>'Qual é a diferença entre hospedagem compartilhada e VPS?','a'=>'Na compartilhada, vários clientes usam a infraestrutura do mesmo ambiente gerenciado. Em um VPS, uma parte virtualizada do servidor tem recursos reservados e mais controle, mas normalmente exige administração técnica.'],
    ['q'=>'Quando devo escolher um VPS?','a'=>'Considere um VPS quando precisar de configuração própria, acesso administrativo ou recursos reservados e houver alguém responsável por atualizações, segurança, backups e monitoramento.'],
    ['q'=>'O menor preço anunciado é o preço que vou pagar sempre?','a'=>'Não necessariamente. Ofertas podem exigir pagamento antecipado por vários meses ou anos e a renovação pode ter outro valor. Confira o total do ciclo, renovação, impostos e itens opcionais no checkout.'],
    ['q'=>'Como as opções foram selecionadas?','a'=>'É uma seleção editorial, sem classificação de desempenho. Consideramos preço e condições publicadas, recursos descritos pelo fornecedor, suporte, facilidade de uso e adequação ao público brasileiro. Não realizamos testes comparativos próprios nem atribuímos notas.'],
];
?>
<section class="hosting-page">
    <header class="hosting-hero">
        <div class="hosting-wrap">
            <p class="eyebrow">GUIA EDITORIAL · ATUALIZADO EM 16/11/2026</p>
            <h1>Encontre a hospedagem que faz sentido para seu projeto</h1>
            <p class="hosting-lead">Seu site precisa de um lugar para crescer. Sua aplicação pode precisar de mais controle. Compare cinco opções de hospedagem compartilhada e cinco de VPS: entenda para quem cada uma serve e o que conferir antes de investir.</p>
            <nav class="hosting-jump" aria-label="Ir para uma categoria"><a href="#compartilhada">Hospedagem compartilhada <span>↓</span></a><a href="#vps">Hospedagem VPS <span>↓</span></a></nav>
            <aside class="hosting-disclosure"><strong>Transparência:</strong> a página pode receber comissão por compras feitas por links indicados, sem custo adicional decorrente da indicação. Comissão não determina a posição. Os links comerciais da KingHost são links de afiliados.</aside>
        </div>
    </header>
    <div class="hosting-wrap hosting-body">
        <aside class="hosting-wizard-invite" aria-labelledby="wizard-invite-title">
            <div><h2 id="wizard-invite-title">Não sabe qual hospedagem escolher?</h2><p>Responda quatro perguntas e receba uma indicação para seu projeto.</p></div>
            <a class="button-link" href="/escolher-hospedagem">Encontrar minha hospedagem →</a>
        </aside>
        <section class="hosting-faq" aria-labelledby="choose-title"><p class="eyebrow">COMECE PELO SEU PROJETO</p><h2 id="choose-title">Qual caminho combina com você?</h2><div class="provider-details"><div><h3>Quero publicar um site ou blog</h3><p>Para um site institucional ou WordPress pequeno, comece pela compartilhada. Você administra o conteúdo sem precisar cuidar de um servidor inteiro.</p><a class="button-link" href="#compartilhada">Comparar hospedagens para sites ↓</a></div><div><h3>Preciso configurar minha aplicação</h3><p>Para Docker, serviços contínuos ou configurações próprias, avalie uma VPS. Planeje quem cuidará de segurança, atualizações e backups.</p><a class="button-link" href="#vps">Comparar servidores VPS ↓</a></div></div></section>
        <aside class="editorial-method"><strong>Como interpretar a lista</strong><p>Esta é uma seleção editorial baseada em informações públicas dos fornecedores. A ordem organiza as alternativas; não indica superioridade. Não fiz testes comparativos de velocidade, disponibilidade ou atendimento. Compare as opções com as necessidades do seu projeto.</p><small>Preços consultados em 16/11/2026 nas páginas oficiais indicadas. Podem mudar. Quando não foi possível confirmar um preço atual, isso está sinalizado.</small></aside>
        <?php foreach ($groups as $category => $providers): ?>
            <section class="hosting-category" id="<?= e($category) ?>">
                <div class="hosting-section-heading"><p class="eyebrow">COMPARATIVO</p><h2>5 opções de <?= e($category === 'compartilhada' ? 'hospedagens compartilhadas' : 'hospedagens VPS') ?></h2><p>Seleção editorial independente para diferentes necessidades e níveis de experiência.</p></div>
                <div class="provider-list">
                <?php foreach ($providers as $index => $provider): $first = false; $cta = $provider['affiliate'] ?: $provider['official']; ?>
                    <article class="provider-card<?= $first ? ' provider-featured' : '' ?>">
                        <header class="provider-head"><span class="provider-rank">#<?= $index + 1 ?></span><?php if ($provider['logo']): ?><img class="provider-logo-image" src="<?= e($provider['logo']) ?>" alt="Logotipo de <?= e($provider['name']) ?>" width="36" height="36" loading="lazy"><?php endif; ?><div class="provider-logo"><?= e($provider['name']) ?></div><?php if ($first): ?><span class="provider-pick">Destaque editorial</span><?php endif; ?></header>
                        <div class="provider-content"><div class="provider-main"><h3><?= e($provider['name']) ?></h3><p><?= e($provider['description']) ?></p><p class="provider-profile"><strong>Indicado para:</strong> <?= e($provider['profile']) ?></p><a class="provider-source" href="<?= e($provider['evidence']) ?>" target="_blank" rel="noopener">Ver fonte e condições consultadas ↗</a></div>
                            <div class="provider-offer"><span class="offer-label">Preço inicial consultado</span><strong><?= e($provider['price'] ?? 'Consulte os planos') ?></strong><p><?= e($provider['conditions']) ?></p><a class="button-link provider-button" href="<?= e($cta) ?>" target="_blank"<?= $provider['affiliate'] ? ' rel="sponsored nofollow noopener"' : ' rel="noopener"' ?>>Ver planos da <?= e($provider['name']) ?> ↗</a></div></div>
                        <div class="provider-details"><div><h4>O que oferece</h4><ul><?php foreach ($provider['advantages'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul></div><div><h4>Confira antes de contratar</h4><ul><?php foreach ($provider['limitations'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul></div></div>
                        <p class="verified-date">Verificação editorial: <time datetime="<?= e($provider['verified']) ?>"><?= e(date('d/m/Y', strtotime($provider['verified']))) ?></time> · <a href="<?= e($provider['affiliate'] ?: $provider['official']) ?>" target="_blank"<?= $provider['affiliate'] ? ' rel="sponsored nofollow noopener"' : ' rel="noopener"' ?>>Site oficial</a></p>
                    </article>
                <?php endforeach; ?>
                </div>
                <div class="comparison-wrap"><h3>Tabela comparativa: <?= e($categoryNames[$category]) ?></h3><div class="comparison-scroll"><table class="hosting-table"><thead><tr><th scope="col">Fornecedor</th><th scope="col">Preço e condição consultados</th><th scope="col">Destaques</th><th scope="col">Mais indicado para</th><th scope="col">Planos</th></tr></thead><tbody>
                <?php foreach ($providers as $provider): ?><tr><th scope="row"><?= e($provider['name']) ?></th><td><?= e($provider['price'] ?? 'Consultar') ?><br><small><?= e($provider['conditions']) ?></small></td><td><?= e(implode('; ', $provider['advantages'])) ?></td><td><?= e($provider['profile']) ?></td><td><a href="<?= e($provider['affiliate'] ?: $provider['official']) ?>" target="_blank"<?= $provider['affiliate'] ? ' rel="sponsored nofollow noopener"' : ' rel="noopener"' ?>>Ver planos ↗</a></td></tr><?php endforeach; ?>
                </tbody></table></div></div>
            </section>
        <?php endforeach; ?>
        <section class="hosting-faq"><h2>Antes de contratar, confira estes quatro pontos</h2><ol><li><strong>Custo completo:</strong> total pago hoje, duração do contrato e valor de renovação.</li><li><strong>O que seu site precisa:</strong> quantidade de sites, armazenamento, bancos de dados e e-mail.</li><li><strong>Proteção dos dados:</strong> frequência e retenção dos backups e como restaurá-los.</li><li><strong>Ajuda na mudança:</strong> condições de migração e o que o suporte realmente cobre.</li></ol><p>Já tem um site? Confirme a migração de arquivos, banco de dados e e-mails antes de cancelar a hospedagem atual.</p></section>
        <section class="hosting-faq" id="perguntas"><p class="eyebrow">DÚVIDAS FREQUENTES</p><h2>Perguntas sobre hospedagem</h2><?php foreach ($faq as $item): ?><details><summary><?= e($item['q']) ?></summary><p><?= e($item['a']) ?></p></details><?php endforeach; ?></section>
    </div>
</section>
<script type="application/ld+json"><?= json_encode(['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>array_map(static fn(array $item): array=>['@type'=>'Question','name'=>$item['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$item['a']]],$faq)], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?></script>
