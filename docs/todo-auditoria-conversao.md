# Correções da auditoria de conversão

Data da auditoria: 21/11/2026. Site: https://blog.paulobezerra.eti.br/.

Este roteiro foi preparado para execução incremental pelo agente Luna 6. O objetivo é corrigir inconsistências técnicas e reduzir o esforço para escolher hospedagem, preservando o blog PHP e os artigos Markdown existentes.

## Instruções para o agente executor

- Execute as tarefas na ordem abaixo. Leia os arquivos envolvidos antes de editar.
- Marque `[x]` somente depois de implementar e verificar o critério de conclusão. Registre o que realmente executou ao final deste documento.
- Não reconstruir o site, instalar dependências, criar páginas, artigos, funcionalidades ou uma nova arquitetura.
- Não publicar, fazer push, alterar campanhas, configurações externas ou contratar serviços. Entregar alterações locais para revisão.
- Preserve alterações pré-existentes do usuário. Comece com `git status --short` e revise o diff final.
- Preserve exatamente as 13 URLs de afiliado registradas em `docs/hostgator-afiliados.md`. Não invente parâmetros, preços, benefícios, testes de desempenho ou garantias de aprovação.
- Manter os 13 serviços disponíveis. A tarefa é reduzir distrações e melhorar o acesso aos produtos pertinentes, não excluir arbitrariamente o catálogo.
- Não transformar comparação editorial com concorrentes em propaganda disfarçada. Não apagar fontes oficiais úteis só porque pertencem a outra empresa.
- Para editar artigos em `content/posts/`, leia e aplique `.agents/skills/escrever-posts-blog/SKILL.md`.
- Se uma tarefa depender de acesso externo indisponível, registre a pendência e conclua as tarefas locais independentes. Não alegue validação em produção por ter testado localmente.

## 1. Corrigir o domínio das URLs públicas — prioridade alta

Arquivos: `public/index.php` e `public/robots.txt`.

Evidência: o blog publicado usa canonical com `https://paulobezerra.eti.br`; o sitemap também lista esse domínio. O robots anuncia `https://paulobezerra.eti.br/sitemap.xml`, que retornou 404 na auditoria.

- [x] Alterar `SITE_URL` para `https://blog.paulobezerra.eti.br`.
- [x] Alterar a linha Sitemap do robots para `https://blog.paulobezerra.eti.br/sitemap.xml`.
- [x] Conferir canonical da home, de `/melhores-hospedagens` e de um artigo renderizado.
- [x] Conferir que todas as URLs do sitemap usam o subdomínio correto.
- [x] Conferir que `og:url`, imagens sociais e `mainEntityOfPage` continuam coerentes com o novo domínio-base.

Conclusão: nenhuma URL absoluta gerada nesses campos usa o domínio antigo. Não substituir endereços de e-mail ou links pessoais legítimos. Não criar redirecionamentos globais sem evidência da configuração de hospedagem.

## 2. Limpar o aviso comercial e esclarecer CTAs — prioridade alta

Arquivos: `templates/hosting.php`, `templates/home.php`, `templates/post.php` e, se contiver chamadas equivalentes, `templates/blog.php`.

- [x] Remover do aviso público a frase sobre exclusividade ser uma regra informada pelo proprietário e não uma política do Google Ads.
- [x] Manter a informação de exclusividade e comissão. Texto sugerido: “Esta seleção reúne apenas serviços HostGator. Se você contratar pelos links, posso receber uma comissão.”
- [x] Preservar cuidados úteis sobre renovação, compatibilidade e administração. Remover apenas duplicações e comentários sobre o processo interno de redação, como “As descrições evitam presumir recursos ou preços não confirmados”.
- [x] Nos cartões, explicitar que o botão abre a HostGator. Sugestão: “Ver planos na HostGator” para hospedagens e servidores; “Ver oferta na HostGator” para os demais. O nome do serviço deve continuar visível no cartão.
- [x] Preservar `target="_blank"` e `rel="sponsored nofollow noopener"` nos 13 CTAs externos.

Conclusão: aviso compreensível para um comprador, sem referência a instruções internas; destino externo claro; URLs de afiliado intactas.

## 3. Priorizar hospedagem simples sem ampliar o site — prioridade alta

Arquivos: `templates/hosting.php`, `templates/home.php`, `templates/post.php`, `templates/blog.php` e, somente se necessário, `public/assets/css/style.css`.

- [x] Nas chamadas genéricas para quem vai publicar um site, substituir a ênfase em “13 serviços” por escolha entre hospedagem de sites, WordPress e criador de sites.
- [x] Fazer o CTA genérico dos artigos apontar para `/melhores-hospedagens#sites`, com texto como “Ver opções HostGator para sites”.
- [x] Fazer a chamada de hospedagem da home apontar para `#sites`, em vez de priorizar o quiz.
- [x] Na página comercial, colocar a seção “Sites e blogs” antes do quiz. Manter o quiz acessível pela âncora `#quiz` e manter as outras categorias disponíveis.
- [x] Preservar IDs de categorias e cartões, pois são usados pelos links e pelo quiz.

Conclusão: o visitante vindo de um artigo sobre domínio ou site chega às três opções pertinentes, sem precisar responder ao quiz. Os 13 cartões continuam acessíveis, inclusive sem JavaScript.

Limite: não criar filtros, novas landing pages, botões flutuantes ou CTAs afiliados dentro dos artigos nesta rodada.

## 4. Corrigir dois caminhos do quiz — prioridade média

Arquivos: `public/assets/js/hosting-wizard.js` e `templates/hosting-wizard.php` se necessário.

- [x] Quando a segunda pergunta tiver apenas uma opção, selecionar essa opção internamente e pular a pergunta. Preservar navegação Voltar e Refazer sem mostrar etapas irrelevantes.
- [x] No caminho “Hospedar uma aplicação” → “Prefiro uma solução gerenciada ou ainda não sei dimensionar”, não recomendar VPS automaticamente.
- [x] Nesse caminho, apresentar resultado inconclusivo: “Ainda não há informação suficiente para indicar um serviço. Defina os requisitos da aplicação e quem administrará o ambiente antes de contratar.” Não destacar cartão nem exibir link de “serviço recomendado”.
- [x] Ao refazer o quiz após esse resultado, restaurar corretamente os controles para caminhos que têm recomendação.
- [x] Preservar os avisos existentes de responsabilidade técnica nos caminhos de servidores e automação.

Verificação manual mínima:

| Caminho | Resultado esperado |
| --- | --- |
| Site → já tenho/vou desenvolver | Hospedagem de Sites |
| Site → ferramenta visual | Criador de Sites |
| WordPress | Hospedagem WordPress sem pergunta redundante |
| Revenda | Revenda sem pergunta redundante |
| Aplicação → gerenciada/não sei dimensionar | Resultado inconclusivo, sem VPS recomendada |
| Aplicação → VPS → sem responsável técnico | Ressalva explícita de administração |
| Automação → n8n → responsável técnico | VPS com n8n |
| Ferramenta específica → AllPass | AllPass |
| Refazer após resultado inconclusivo → WordPress | Recomendação e link restaurados |

Conclusão: todos os caminhos acima funcionam, sem erros no console. O resultado inconclusivo não tenta acessar um produto inexistente.

## 5. Ajustar linguagem e links editoriais — prioridade média

Arquivos: `src/HostingProviders.php`, `templates/home.php` e artigos em `content/posts/`.

- [x] Nas descrições de produtos, remover tautologias como “Ferramenta para criar e publicar um site usando o produto Criador de Sites”. Usar as finalidades já documentadas no catálogo, sem acrescentar recursos não verificados.
- [x] Manter diferenças práticas: publicar um site existente, montar um site visualmente, usar WordPress, administrar servidor. Não prometer que uma opção é superior sem evidência.
- [x] Ajustar a apresentação da home para não prometer uma variedade de assuntos ausente do acervo. Exemplo: “Sou desenvolvedor e Tech Lead. Aqui compartilho explicações sobre domínio, hospedagem e os cuidados para colocar um projeto na web.” Preservar a biografia factual.
- [x] Localizar links para `/melhores-hospedagens` nos artigos. Substituir âncoras que sugerem vários fornecedores, como “compare outras opções de hospedagem”, por “veja opções de hospedagem da HostGator” ou expressão equivalente adequada ao parágrafo.
- [x] Nos artigos voltados a publicar sites comuns, usar `/melhores-hospedagens#sites` quando esse for o destino pertinente.
- [x] Preservar títulos, slugs e conteúdo das comparações com Hostinger. Não redirecionar essas páginas nem remover fontes editoriais legítimas.

Conclusão: a exclusividade comercial fica clara antes do clique; não há reescrita extensa dos artigos nem novas alegações sobre fornecedores.

## 6. Ajustar metadados de apresentação — prioridade baixa

Arquivo: `public/index.php`.

- [x] Trocar o title da home, atualmente apenas “Paulo Bezerra”, por algo descritivo, como “Domínio, hospedagem e tecnologia | Paulo Bezerra”.
- [x] Ajustar a description comercial para enfatizar a escolha e a contratação consciente, em vez da quantidade de produtos e do quiz. Exemplo: “Entenda qual serviço HostGator faz sentido para seu projeto e confira cuidados com requisitos, cobrança e renovação antes de contratar.”
- [x] Preservar titles e descriptions específicos dos artigos.

Conclusão: metadados presentes, coerentes com a página e sem promessa de menor preço, desconto ou superioridade não comprovada.

## 7. Verificação final local

- [x] Executar `php -l` em cada arquivo PHP alterado.
- [x] Executar `node --check public/assets/js/hosting-wizard.js` se o quiz foi alterado.
- [x] Conferir HTML renderizado: canonical, metadados, 13 cartões e correspondência exata das 13 URLs com `docs/hostgator-afiliados.md`.
- [x] Validar o XML do sitemap e os destinos das âncoras alteradas.
- [x] Verificar navegação e apresentação em desktop e celular quando houver navegador disponível: menu, CTAs, quiz, ausência de sobreposição e rolagem horizontal.
- [x] Conferir que uma URL inexistente retorna HTTP 404. O servidor PHP local retornou 404 para `/rota-inexistente`; o roteamento existente está correto.
- [x] Revisar `git diff --check`, `git diff --stat` e o diff completo. Não incluir mudanças alheias ao roteiro.
- [x] Atualizar a descrição do quiz em `docs/hostgator-afiliados.md` se o comportamento documentado tiver mudado. Preservar a tabela de URLs.

Não criar uma suíte de testes nova para as alterações textuais. Para o quiz, verificar os cenários definidos na tarefa 4. Se usar o servidor embutido do PHP, lembrar que ele não processa `.htaccess`: a rota interna do sitemap é `index.php?route=sitemap`; o caminho público `/sitemap.xml` precisa ser validado no ambiente que aplica a reescrita.

## 8. Pendências externas — não marcar como concluídas por inferência

Estas verificações dependem de acesso, evidências ou publicação autorizada separadamente. Não bloqueiam a entrega das correções locais.

- [ ] Após publicação autorizada, repetir as verificações de canonical, robots e sitemap no site público.
- [ ] No Search Console, verificar indexação das páginas e canonical selecionado pelo Google. Resposta HTTP 200 não comprova indexação.
- [ ] Abrir os links afiliados em navegador comum e conferir o produto de destino. Na auditoria, os 13 acessos automatizados retornaram 403; isso não comprova links quebrados.
- [ ] Conferir atribuição no painel de afiliados usando procedimento permitido pelo programa. Não realizar compra de teste sem autorização.
- [x] Consultar os [termos oficiais do programa de afiliados da HostGator](https://www.hostgator.com.br/termos-afiliados). Na consulta de 21/11/2026, os termos proíbem anúncios patrocinados em redes sociais e compra de palavras-chave relacionadas à marca, inclusive combinações com outros termos; não interpretar isso como autorização ampla para outras formas de tráfego pago.
- [ ] Conferir no GTM/Analytics os eventos de saída para a HostGator e sua distinção de vendas efetivas. O carregamento do GTM não comprova medição correta.
- [ ] Avaliar aprovação real no Google Ads pela conta correspondente. Não prometer aprovação com base nesta lista.

## Registro da execução

- Tarefas concluídas: tarefas 1 a 6. Item 7 executado; todas as verificações locais previstas passaram, incluindo resposta HTTP 404 para rota inexistente.
- Arquivos alterados: `public/index.php`, `public/robots.txt`, `public/assets/js/hosting-wizard.js`, `src/HostingProviders.php`, `templates/hosting.php`, `templates/home.php`, `templates/post.php`, `templates/blog.php`, `docs/hostgator-afiliados.md` e oito artigos em `content/posts/` com ajuste de texto/destino de link. O roteiro `docs/todo-auditoria-conversao.md` foi atualizado.
- Comandos e verificações executados, com resultados: `php -l` em todos os PHP alterados e nos templates relevantes passou; `node --check public/assets/js/hosting-wizard.js` passou; renderizações CLI de home, página comercial, artigo e sitemap passaram; os canonical e `og:url` correspondem ao domínio novo, as imagens sociais usam esse domínio e `mainEntityOfPage` do artigo corresponde ao canonical; sitemap gerado analisado como XML válido; via HTTP local, rota inexistente retornou 404, home, página comercial, artigo, robots.txt e endpoint interno do sitemap retornaram 200; as 13 URLs renderizadas correspondem exatamente à tabela de `docs/hostgator-afiliados.md`, com `target="_blank"` e `rel="sponsored nofollow noopener"`; âncoras de categoria e `#sites` existem; `git diff --check` passou. Capturas no Chrome headless em 390 px e 1440 px foram inspecionadas, sem sobreposição ou rolagem horizontal aparente.
- Cenários do quiz verificados: Site → já tenho/vou desenvolver → Hospedagem de Sites; Site → ferramenta visual → Criador de Sites; WordPress → Hospedagem WordPress sem pergunta redundante; Revenda → Revenda sem pergunta redundante; Aplicação → gerenciada/não dimensionada → inconclusivo sem link recomendado; Aplicação → VPS → sem responsável técnico → ressalva de administração; Automação → n8n → responsável técnico → VPS com n8n; Ferramenta específica → AllPass; refazer após resultado inconclusivo → WordPress com recomendação/link restaurado; navegação Voltar e botão de menu móvel. Todos passaram no Chrome headless.
- Verificações não executadas e motivo: O caminho público `/sitemap.xml` não foi validado no servidor embutido, que não aplica `.htaccess`; o endpoint interno `/?route=sitemap` retornou XML válido via HTTP. As verificações restantes do item 7 foram executadas.
- Pendências externas no registro anterior: nenhuma consulta pública, publicação, teste de links afiliados ou ação externa foi feita naquela execução.
- Estado da branch e alterações pré-existentes preservadas: branch `main`; no início já constavam `AD copy-site-paulo-bezerra.md` e `AD skill-gerar-posts-blog.md` (adições staged com arquivos removidos da árvore de trabalho) e o roteiro fornecido estava não rastreado. Essas alterações foram preservadas sem edição.
- Publicação: não realizada.

## Validação final e pendências externas — 21/11/2026

- Validação local repetida: `php -l` em todos os arquivos PHP encontrados no projeto passou; `node --check public/assets/js/hosting-wizard.js` passou; `git diff --check` passou. Não foram feitas alterações no código nesta etapa.
- Site público: não validado. A tentativa de acesso a `https://blog.paulobezerra.eti.br/` falhou com `curl: (6) Could not resolve host`; a ferramenta de consulta web também não conseguiu abrir home, `/robots.txt` nem `/sitemap.xml`. Isso não permite concluir que o site esteja fora do ar para visitantes em geral.
- Política de afiliados: consulta direta aos termos oficiais confirmou as restrições descritas no item 8. Isso responde à dúvida sobre marca e palavras-chave, mas não constitui aprovação da conta nem autorização para práticas não explicitamente permitidas.
- Permanecem pendentes: validação pública de canonical/robots/sitemap após a publicação; indexação e canonical escolhido no Search Console; destino dos 13 links em navegador comum; atribuição no painel de afiliados; conferência dos eventos de saída no GTM/Analytics; e avaliação real de anúncios na conta Google Ads. Não houve publicação, compra de teste ou alteração em contas externas.
- As ferramentas ativas não oferecem acesso direto às contas Search Console/Analytics/Ads nem ao painel de afiliados. O catálogo sugere conectores de terceiros, mas nenhum foi instalado ou conectado nesta execução.

## Revisão do Astra — itens 1 a 7

**Base revisada** — commit `53bb14a` em `main`, comparado a `df446e8`. Os marcadores anteriores registram a execução do Luna. As pendências abaixo ficam para implementação pelo Luna, nova revisão pelo Astra e decisão de aprovação e publicação pelo Paulo.

- [x] **Prioridade média · itens 1 e 7 · imagem social ausente.** `templates/layout.php` agora usa `/assets/images/dominio-registro-br-onde-hospedar.svg`, existente e pertinente; a renderização CLI confirmou `og:image` e `twitter:image` na home. A capa própria dos artigos continua sendo usada. Validação HTTP local concluída: home e página comercial referenciam imagem com resposta 200 e Content-Type `image/svg+xml`.
- [x] **Prioridade média · item 4 · pergunta sem efeito no quiz.** O caminho gerenciado encerra após a segunda resposta com orientação inconclusiva e sem link recomendado. Reinício e demais caminhos mantêm seu fluxo.
- [x] **Prioridade baixa · item 3 · orientação sem JavaScript.** O aviso aponta para “Sites e blogs”, seção localizada acima do quiz.
- [x] **Prioridade baixa · item 5 · assuntos anunciados na home.** A lista agora anuncia domínio, hospedagem, infraestrutura e dicas práticas, sem remover a experiência profissional descrita na biografia.
- [x] **Prioridade baixa · item 5 · destino editorial para VPS.** O artigo oferece links separados: hospedagem compartilhada para `#sites` e VPS para `#infraestrutura`.

**Verificação independente.** Passaram o lint dos seis PHP alterados, a análise de sintaxe do JavaScript e `git diff --check` entre os commits. A renderização local confirmou canonical e `og:url` na home, no comparativo e em um artigo, além de `mainEntityOfPage` no artigo. O XML do sitemap contém 14 URLs no subdomínio correto. Os 13 cartões renderizados sem executar JavaScript associam cada produto à sua URL exata na tabela anterior à implementação e preservam os atributos dos links comerciais. A revisão do quiz foi por leitura do fluxo. Os testes de navegador, layout e HTTP descritos pelo Luna não foram repetidos pelo Astra nesta rodada. O item 8 continua reservado à etapa externa.

**Execução das correções do Astra.** Itens 1 a 5 implementados localmente. A capa dos artigos permanece individual; a nova imagem padrão atende home e comparativo. O caminho gerenciado do quiz não pergunta sobre administração, enquanto VPS, dedicado e automação continuam com pergunta técnica. Itens 6 e 7 continuam fora do escopo desta lista; pendências externas do item 8 não foram alteradas. `php -l` passou em `templates/layout.php`, `templates/home.php` e `templates/hosting-wizard.php`; `node --check public/assets/js/hosting-wizard.js` e `git diff --check` também passaram. A renderização PHP CLI da home confirmou as duas tags sociais apontando para a imagem escolhida e os rótulos revisados. A renderização da página comercial confirmou `#sites` antes do quiz e a mensagem sem JavaScript. A imagem existe localmente e `mime_content_type` identificou `image/svg+xml`. A validação complementar via HTTP confirmou home, página comercial e dois artigos com resposta 200, tags sociais coerentes e imagens servidas com tipo de imagem; a capa individual do segundo artigo foi preservada. O artigo revisado contém os dois destinos corretos. No Chrome headless passaram: aplicação gerenciada com resultado após duas respostas, sem destaque ou link; reinício para WordPress; sites, criador, revenda, VPS e dedicado com ressalvas; três caminhos de automação; AllPass; Voltar de VPS para gerenciada. Não houve exceções JavaScript. Com JavaScript desativado, o aviso e a seção Sites e blogs foram confirmados. Os processos temporários PHP e Chrome iniciados nesta rodada foram encerrados. As cinco correções estão implementadas e verificadas localmente; as pendências externas permanecem abertas.
