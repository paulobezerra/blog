# Blog Paulo Bezerra

Blog editorial em PHP 8.2+ que lê arquivos Markdown em cada requisição. Não usa banco de dados, painel administrativo, processo em segundo plano ou build de frontend.

## Requisitos

- PHP 8.2 ou superior com extensões padrão necessárias ao Composer.
- Apache com `mod_rewrite` e permissão para usar `.htaccess` (`AllowOverride All`).
- Composer apenas para instalar a dependência durante a preparação local. O servidor não precisa de Composer se a pasta `vendor/` for enviada junto.

## Executar localmente

```bash
composer install
php -S 127.0.0.1:8000
```

Abra <http://127.0.0.1:8000>. O servidor embutido do PHP não aplica `.htaccess`; teste as URLs amigáveis em Apache.

## Instalar dependências

Na raiz do projeto:

```bash
composer install --no-dev --optimize-autoloader
```

O Markdown é convertido por `league/commonmark`, instalado em `vendor/`. Inclua essa pasta no pacote de publicação. Não é necessário executar Composer na hospedagem.

## Publicar em hospedagem compartilhada

1. Aponte o domínio para a pasta pública deste projeto e confirme PHP 8.2+.
2. Envie os arquivos do projeto, incluindo `vendor/`, `.htaccess` e os diretórios `content/`, `src/`, `templates/` e `assets/`.
3. Ative `mod_rewrite` e permita `.htaccess`. O site precisa ler os Markdown e a dependência; não precisa gravar arquivos.
4. Confira as páginas `/`, `/blog`, `/sobre`, `/contato`, `/privacidade` e `/sitemap.xml`.
5. Se usar outro domínio, altere `SITE_URL` em `index.php` e a linha `Sitemap` em `robots.txt`.

O `.htaccess` bloqueia o acesso HTTP a `content/`, `src/`, `templates/`, `vendor/` e arquivos de configuração. Mantenha-os dentro da raiz configurada para o site e não publique credenciais nesse repositório.

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

Coloque imagens em `assets/images/` e use o caminho público começando por `/assets/images/`. Prefira arquivos otimizados, com dimensões adequadas ao uso. A capa aparece nos cards e no artigo; artigos sem capa recebem um bloco visual neutro.

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

Altere `SITE_NAME` e `SITE_URL` em `index.php`, o e-mail nas páginas `templates/contato.php` e `templates/privacidade.php`, o nome e a apresentação em `templates/sobre.php`, e a URL do sitemap em `robots.txt`. Ajuste também o conteúdo de privacidade se adicionar ferramentas de análise, publicidade ou coleta de dados.
# blog
