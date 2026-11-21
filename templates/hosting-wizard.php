<section class="hosting-wizard-invite" id="quiz" aria-labelledby="wizard-title">
  <div class="wizard-intro"><p class="eyebrow">QUIZ DE ESCOLHA</p><h2 id="wizard-title">Qual serviço vale avaliar para seu projeto?</h2><p>Responda perguntas curtas. A indicação é um ponto de partida; confirme requisitos e condições.</p></div>
  <noscript><p>O quiz precisa de JavaScript. A comparação dos 13 serviços e seus links continua disponível abaixo.</p></noscript>
  <div id="hosting-wizard" hidden>
    <p class="wizard-privacy">Suas respostas ficam nesta página e não são enviadas nem salvas pelo código do quiz.</p>
    <p id="wizard-progress" aria-live="polite"></p>
    <form id="wizard-form"><fieldset id="wizard-question"></fieldset><p id="wizard-error" role="alert"></p><div class="wizard-actions"><button type="button" id="wizard-back">Voltar</button><button type="submit" id="wizard-next">Continuar →</button></div></form>
    <section id="wizard-result" hidden aria-labelledby="wizard-result-title"><h3 id="wizard-result-title" tabindex="-1"></h3><p id="wizard-reason"></p><p id="wizard-caution"></p><div class="wizard-actions"><a id="wizard-service-link" class="button-link" href="#">Ver serviço recomendado ↓</a><button type="button" id="wizard-restart">Refazer respostas</button></div></section>
  </div>
</section>
<script id="wizard-catalog" type="application/json"><?= json_encode(array_merge(...array_values($page['providers'])), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?></script>
<script src="/assets/js/hosting-wizard.js" defer></script>
