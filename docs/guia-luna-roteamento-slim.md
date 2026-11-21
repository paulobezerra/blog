# Guia para o Luna · Migrar o roteamento para Slim 4

Luna, concentre a mudança no caminho entre a requisição HTTP e os templates PHP existentes. Hoje, adicionar uma página exige editar o mesmo arquivo que pagina artigos, gera XML e atende o servidor local. Ao final, deve ser possível localizar cada URL em uma tabela de rotas e alterar sua resposta sem abrir `public/index.php`.

## Contrato das rotas

Antes da migração, capture status, cabeçalhos e corpo de exemplos locais para comparar depois. Use a [auditoria de conversão](todo-auditoria-conversao.md) como referência para os metadados, o quiz e os links comerciais.

| Caminho | Comportamento a preservar |
| --- | --- |
| `/`, `/index.php` | Home com os artigos recentes e canonical na raiz. |
| `/blog` | Dez artigos publicados por página, na ordem de `Posts::all()`. Ausência de `page`, valor inválido ou menor que 1 abre a primeira página. Página além da última mantém a listagem vazia com status 200. |
| `/blog/{slug}` | Buscar com `Posts::find()`, inclusive arquivos com prefixo de data. Artigo publicado recebe 200. Slug inválido, ausente no acervo ou em rascunho recebe a página 404 do blog. |
| `/melhores-hospedagens` | Comparativo com o catálogo de `hostingProviders()`, os links de afiliados e o quiz. |
| `/escolher-hospedagem` | 301 com `Location: /melhores-hospedagens#quiz`. |
| `/sobre`, `/contato`, `/privacidade` | Cada página mantém seu template, título e descrição. |
| `/sitemap.xml`, `/sitemap` | Mesmo XML, com as páginas fixas e uma URL por artigo publicado. Preservar escape de XML e `application/xml; charset=utf-8`. |
| Caminho desconhecido | Layout do site com status HTTP 404. |

## Implementação sugerida

1. Na raiz, execute `composer require slim/slim:"^4" slim/psr7`. Mantenha PHP 8.2+ e CommonMark. Inclua o lock atualizado e confira o pacote de publicação com `vendor/`. [Instalação oficial do Slim](https://www.slimframework.com/docs/v4/start/installation.html)
2. Crie `src/bootstrap.php` para carregar a configuração do site, instanciar `Posts`, criar a aplicação com `AppFactory::create()`, registrar rotas e devolver o app. Carregue as classes e funções locais explicitamente ou pelo autoload do projeto. Mantenha `public/index.php` como ponto de entrada tanto no Apache quanto no comando local existente. Preserve antes do autoload a delegação de arquivos públicos ao servidor embutido; a inicialização do Slim fica assim:

   ```php
   <?php
   declare(strict_types=1);

   require dirname(__DIR__) . '/vendor/autoload.php';
   $app = require dirname(__DIR__) . '/src/bootstrap.php';
   $app->run();
   ```

3. Declare as rotas GET em `src/routes.php`, associando caminhos a handlers. Agrupe por responsabilidade, por exemplo páginas editoriais, catálogo e sitemap. Mantenha paginação e montagem do XML nos respectivos handlers. Consulte `Posts::all()` apenas onde a resposta consome a lista. Leia `page` de `$request->getQueryParams()` e o slug dos argumentos da rota.
4. Reutilize `templates/layout.php` em uma função de renderização que receba os dados da página e a resposta PSR-7. Capture a saída do template com buffer, escreva o HTML no corpo e devolva a resposta com status e cabeçalhos. Carregue o helper global `e()` uma única vez para permitir duas renderizações no mesmo processo. Construa o canonical com `SITE_URL` e o caminho normalizado, sem query string.
5. Registre o middleware de roteamento e depois o de erros, com detalhes desativados em produção. Associe `HttpNotFoundException` ao mesmo renderizador 404 usado para artigos indisponíveis. Para o 301, devolva a resposta de `withHeader('Location', '/melhores-hospedagens#quiz')->withStatus(301)`. [Middleware de roteamento](https://www.slimframework.com/docs/v4/middleware/routing.html)

## Apache, servidor local e URLs antigas

- Em `public/.htaccess`, remova a reescrita específica de `sitemap.xml` para `?route=sitemap`. A regra geral já encaminha caminhos virtuais a `index.php` e deixa arquivos e diretórios existentes com o Apache. Mantenha `public/` como document root.
- Para o servidor embutido, mantenha `php -S 127.0.0.1:8000 -t public public/index.php`. No index, sob a condição `PHP_SAPI === 'cli-server'`, carregue `src/static-files.php` e use `isPublicFile()` para devolver `false` quando o arquivo público existir. Essa função resolve o caminho com `realpath` e verifica o confinamento em `public/`, inclusive para links simbólicos. Não crie outro entrypoint nem cadastre assets nas rotas Slim. No Apache, os arquivos existentes continuam sendo atendidos diretamente pelas condições `!-f` e `!-d` do `.htaccess`. A configuração de `SITE_URL` fica em `src/bootstrap.php`.
- Preserve a tolerância à barra final antes do despacho, inclusive em `/blog/`. O index atual também dá precedência a `?route=`. Para preservar links antigos, traduza esse parâmetro em caminho interno da requisição antes do roteamento, mantendo os demais parâmetros. Cubra `/index.php?route=sitemap` e `/?route=blog&page=2`. Use a tabela de rotas para resolver o caminho.
- O index atual ignora o método HTTP. Ao registrar GET, valide também HEAD e registre a mudança esperada para métodos sem rota, como POST retornando 405.

## Critérios de aceite

- [ ] O index mantém a delegação mínima de arquivos públicos exclusiva do servidor embutido, seguida de autoload, inicialização e execução. O entrypoint e o comando local são preservados. Cada caminho da tabela tem um handler identificável.
- [ ] `composer validate`, instalação pelo lock e `php -l` nos PHP alterados passam.
- [ ] Via HTTP, confira a tabela, os aliases, a barra final, a paginação e os 404. Inspecione o 301 sem seguir o redirecionamento para verificar também o fragmento.
- [ ] Compare canonical, Open Graph e dados estruturados com a captura inicial. Confira os 13 links comerciais, seus atributos e o destino da âncora do quiz conforme a auditoria.
- [ ] Analise o corpo de `/sitemap.xml` com um parser XML e confira o domínio `https://blog.paulobezerra.eti.br`. Verifique que `/robots.txt` aponta para essa URL e que um asset real retorna seu conteúdo.
- [ ] Teste o sitemap e os estáticos tanto no servidor embutido quanto em Apache com reescrita. Registre o ambiente e os resultados, indicando qualquer verificação pendente. A validação pública após publicação continua no item 8 da auditoria.
