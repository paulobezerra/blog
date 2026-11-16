<section class="hosting-page">
    <header class="hosting-hero"><div class="hosting-wrap">
        <a class="back-link" href="/melhores-hospedagens">← Comparativo de hospedagens</a>
        <p class="eyebrow">ASSISTENTE DE ESCOLHA</p>
        <h1>Qual hospedagem combina com seu projeto?</h1>
        <p class="hosting-lead">Quatro respostas para escolher um tipo de serviço e saber o que conferir antes de contratar.</p>
    </div></header>
    <div class="hosting-wrap hosting-body">
        <noscript><p>Ative o JavaScript para usar o assistente ou <a class="text-link" href="/melhores-hospedagens">consulte o comparativo de hospedagens</a>.</p></noscript>
        <div id="hosting-wizard" hidden>
            <p>As respostas ficam apenas nesta página e não são enviadas nem salvas.</p>
            <p id="wizard-progress" aria-live="polite"></p>
            <form id="wizard-form">
                <fieldset id="wizard-question"></fieldset>
                <p id="wizard-error" role="alert"></p>
                <div class="wizard-actions"><button type="button" id="wizard-back">Voltar</button><button type="submit" class="button-link" id="wizard-next">Continuar →</button></div>
            </form>
            <section id="wizard-result" hidden aria-labelledby="wizard-result-title">
                <h2 id="wizard-result-title" tabindex="-1"></h2>
                <p id="wizard-reason"></p>
                <ul id="wizard-checks"></ul>
                <div id="wizard-providers" class="provider-list"></div>
                <p>Indicação por perfil, sem teste de desempenho ou garantia de compatibilidade. A existência de comissão não altera o resultado. Links patrocinados são identificados em cada opção.</p>
                <p><a class="text-link" href="/blog/hospedagem-dominio-gratis">Entenda quando o domínio grátis compensa</a></p>
                <button type="button" id="wizard-restart">Refazer respostas</button>
                <a class="text-link" href="/melhores-hospedagens">Ver comparativo completo</a>
            </section>
        </div>
    </div>
</section>
<script id="wizard-catalog" type="application/json"><?= json_encode(array_merge(...array_values($page['providers'])), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?></script>
<script src="/assets/js/hosting-wizard.js" defer></script>
