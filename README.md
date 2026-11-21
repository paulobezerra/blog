# Blog Paulo Bezerra

Blog editorial em PHP 8.2+ que lê arquivos Markdown em cada requisição. Não usa banco de dados, painel administrativo, processo em segundo plano ou build de frontend.

## Requisitos

- PHP 8.2 ou superior com extensões padrão necessárias ao Composer.
- Apache com `mod_rewrite` e permissão para usar `.htaccess` (`AllowOverride All`).
- Composer apenas para instalar a dependência durante a preparação local. O servidor não precisa de Composer se a pasta `vendor/` for enviada junto.

## Executar localmente

```bash
composer install
php -S 127.0.0.1:8000 -t public public/index.php
```

Abra <http://127.0.0.1:8000>. O servidor embutido do PHP não aplica `.htaccess`; teste as URLs amigáveis em Apache.

## Instalar dependências

Na raiz do projeto:

```bash
composer install --no-dev --optimize-autoloader
```

O Markdown é convertido por `league/commonmark`; o roteamento HTTP usa Slim 4. Inclua `vendor/` no pacote de publicação. Não é necessário executar Composer na hospedagem.

## Publicar em hospedagem compartilhada

1. Aponte o document root do domínio para a pasta `public/` e confirme PHP 8.2+.
2. Envie o projeto completo, incluindo `vendor/`, `content/`, `src/`, `templates/` e `public/`. Apenas `public/` deve ser acessível pelo domínio; mantenha Composer e os demais diretórios fora do document root.
3. Ative `mod_rewrite` e permita `.htaccess`. O site precisa ler os Markdown e a dependência; não precisa gravar arquivos.
4. Confira as páginas `/`, `/blog`, `/sobre`, `/contato`, `/privacidade` e `/sitemap.xml`.
5. Se usar outro domínio, altere `SITE_URL` em `src/bootstrap.php` e a linha `Sitemap` em `public/robots.txt`.

O único `.htaccess` fica em `public/` e direciona as rotas ao front controller. Como os arquivos de aplicação, conteúdo, dependências e configuração ficam fora do document root, não são servidos pelo Apache. Não publique credenciais nesse repositório.

## Google Analytics 4

Crie uma propriedade GA4 e um fluxo de dados da Web para o domínio. Configure a variável de ambiente `GA4_MEASUREMENT_ID` no ambiente PHP da hospedagem com o ID de medição do fluxo (formato `G-...`); sem um ID válido, a tag não é carregada. Para testar localmente, inicie o servidor com `GA4_MEASUREMENT_ID=G-SEUID php -S 127.0.0.1:8000 -t public public/index.php`.

No fluxo da Web, ative a medição otimizada e a opção de cliques de saída. A tag registra visualizações de página; consulte `/melhores-hospedagens` no relatório de páginas e use o evento automático `click` e a URL do link para analisar saídas para fornecedores. Outros links externos também geram esse evento; links que não forem reconhecidos como externos, incluindo domínios configurados para medição entre domínios, não serão contados como saídas. Não há evento personalizado de venda.

Identifique campanhas com parâmetros UTM (por exemplo, `utm_source`, `utm_medium` e `utm_campaign`) e consulte os relatórios de aquisição. Evite dados pessoais nas URLs e nos parâmetros de campanha. Confira a coleta em Tempo real ou DebugView após configurar a propriedade. Cliques não são vendas: acompanhe as comissões confirmadas no painel de cada programa de afiliados.

Antes de ativar a tag, avalie os requisitos legais de privacidade e consentimento aplicáveis ao público do site e implemente os controles necessários. Revise também as configurações de retenção e compartilhamento de dados na propriedade do Analytics.

## Criar um artigo

Crie um arquivo `.md` em `content/posts/`. O nome do arquivo vira o slug, por exemplo `guia-de-backups.md` gera `/blog/guia-de-backups`.

```markdown
---
title: Um título claro
description: Resumo curto para listagens e mecanismos de busca.
date: 2026-11-16
category: Guias
tags: web, segurança
cover: /assets/images/guia.webp
published: true
---

# Um título claro

Escreva o conteúdo em Markdown.
```

Use `published: false` para manter um rascunho fora do blog e do sitemap. Artigos publicados são ordenados da data mais recente para a mais antiga. O conteúdo é lido novamente a cada requisição.

São aceitos títulos, parágrafos, listas, tabelas, links, imagens, citações e blocos de código do GitHub Flavored Markdown. HTML escrito no Markdown é escapado.

## Imagens e links comerciais

Coloque imagens em `public/assets/images/` e use o caminho público começando por `/assets/images/`. Prefira arquivos otimizados, com dimensões adequadas ao uso. A capa aparece nos cards e no artigo; artigos sem capa recebem um bloco visual neutro.

Links comuns usam a sintaxe Markdown habitual. Para um CTA destacado, use uma linha com:

```text
{{button|Ver detalhes|https://exemplo.com/produto}}
```

Para um link patrocinado que receba explicitamente `rel="sponsored nofollow"`:

```text
{{sponsored|Conhecer o serviço|https://exemplo.com/servico}}
```

Esses dois marcadores ativam o aviso de transparência no artigo. Use-os apenas quando houver relação comercial aplicável e mantenha informações, preços e recomendações verificáveis e atualizadas.

## Dados pessoais e domínio

Altere `SITE_NAME` e `SITE_URL` em `src/bootstrap.php`, o e-mail nas páginas `templates/contato.php` e `templates/privacidade.php`, o nome e a apresentação em `templates/sobre.php`, e a URL do sitemap em `public/robots.txt`. Ajuste também o conteúdo de privacidade se adicionar ferramentas de análise, publicidade ou coleta de dados.
# blog
