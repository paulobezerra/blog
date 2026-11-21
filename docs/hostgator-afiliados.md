# Links de afiliado da HostGator

Aprovação informada e links fornecidos por Paulo em 21/11/2026. Preserve cada URL exatamente como registrada nesta tabela.

| Serviço | Link aprovado |
|---|---|
| Hospedagem de Sites | https://www.hostgator.com.br/53582-77-3-32.html |
| Criador de Sites | https://www.hostgator.com.br/53582-78-3-33.html |
| Hospedagem WordPress | https://www.hostgator.com.br/53582-128-3-36.html |
| Servidor VPS | https://www.hostgator.com.br/53582-13-3-12.html |
| Servidor Dedicado | https://www.hostgator.com.br/53582-2-3-11.html |
| Revenda | https://www.hostgator.com.br/53582-126-3-34.html |
| VPS com n8n | https://www.hostgator.com.br/53582-137-3-46.html |
| VPS com OpenClaw | https://www.hostgator.com.br/53582-141-3-52.html |
| VPS com GatorClaw | https://www.hostgator.com.br/53582-142-3-53.html |
| Evolution Go | https://www.hostgator.com.br/53582-144-3-55.html |
| Evolution API | https://www.hostgator.com.br/53582-145-3-56.html |
| Evolution CRM | https://www.hostgator.com.br/53582-146-3-58.html |
| AllPass | https://www.hostgator.com.br/53582-147-3-59.html |

## Uso no projeto

`src/HostingProviders.php` mantém os identificadores estáveis dos 13 serviços e a função `hostingAffiliateLinks()` mapeia cada identificador ao link aprovado acima. `templates/hosting.php` usa esses destinos em todos os CTAs comerciais da comparação e `templates/hosting-wizard.php` fornece o catálogo ao quiz. Links comerciais abrem nova aba e usam `rel="sponsored nofollow noopener"`.

A página `/melhores-hospedagens` contém comparação, quiz e cartões dos 13 serviços. A URL antiga `/escolher-hospedagem` responde com redirecionamento permanente para `/melhores-hospedagens#quiz` e não está no sitemap. A documentação KingHost e artigos existentes não fazem parte desta seleção comercial.

O quiz pergunta objetivo, necessidade específica e, apenas para aplicação/automação em servidor, capacidade de administração técnica. Ele mostra uma opção para avaliação, justificativa e ressalvas. Quando não há responsável técnico definido, o resultado deixa claro que VPS não é uma solução sem manutenção e recomenda confirmar o escopo gerenciado e a compatibilidade antes da contratação. Respostas são mantidas apenas em memória na página. Sem JavaScript, os cartões e links continuam visíveis.

As finalidades de n8n, OpenClaw, GatorClaw, Evolution Go, Evolution API, Evolution CRM e AllPass foram conferidas na documentação/páginas oficiais da HostGator. Fontes consultadas: [VPS com n8n](https://suporte.hostgator.com.br/hc/pt-br/articles/43048642887059-Como-funciona-a-VPS-com-n8n-da-HostGator), [instalar OpenClaw na VPS](https://suporte.hostgator.com.br/hc/pt-br/articles/50279666686739-Como-instalar-e-configurar-manualmente-o-OpenClaw-na-VPS), [termos do GatorClaw](https://suporte.hostgator.com.br/hc/pt-br/articles/49551572161555-Termos-de-Uso-do-GatorClaw), [catálogo oficial de aplicações VPS](https://www.hostgator.com.br/aplicacoes), [VPS com Evolution API](https://suporte.hostgator.com.br/hc/pt-br/articles/50492079426323-Como-funciona-a-VPS-com-Evolution-API), [Evolution CRM](https://www.hostgator.com.br/servidor-vps/evolution-crm), [AllPass](https://suporte.hostgator.com.br/hc/pt-br/articles/52816008401811-Como-contratar-o-AllPass). A página não publica preços nem promessas de compatibilidade; condições e requisitos devem ser confirmados na oferta atual. Esta seleção exclusiva é uma regra comercial informada pelo proprietário do site, não uma política geral do Google Ads verificada.

## Verificações realizadas

- `php -l` passou em `src/HostingProviders.php`, `templates/hosting.php`, `templates/hosting-wizard.php`, `public/index.php`, `templates/layout.php`, `templates/home.php`, `templates/blog.php` e `templates/post.php`.
- `node --check public/assets/js/hosting-wizard.js` passou.
- Renderização CLI de `templates/hosting.php`: 13 cartões, 13 URLs de CTA únicas, correspondentes exatamente às 13 URLs desta tabela; não foram encontrados nomes dos fornecedores removidos no HTML renderizado.
- A renderização confirmou cartões e links comerciais no HTML sem executar JavaScript. O sitemap gerado em CLI foi analisado como XML válido, inclui `/melhores-hospedagens` e não inclui `/escolher-hospedagem`. O servidor PHP local não pôde iniciar neste ambiente, então não foi possível inspecionar o status/cabeçalho HTTP do redirecionamento nem fazer teste visual em navegador para foco, scroll, teclado ou layout mobile.
- Não foi executado teste automatizado de cada caminho interativo do quiz. Nenhum teste de atribuição de comissão foi realizado e nada foi publicado em produção.
