---
name: escrever-posts-blog
description: Escrever, revisar ou atualizar artigos Markdown do blog pessoal de Paulo Bezerra, respeitando o formato do projeto, a linguagem editorial e os links internos. Use quando a tarefa mencionar novo post, artigo, conteúdo do blog, SEO de artigo ou edição de um arquivo em content/posts/.
---

# Skill: escrever posts para paulobezerra.eti.br

Os caminhos do projeto abaixo são relativos à raiz do repositório, não à pasta desta skill.

## Missão

Produzir artigos úteis para um blog pessoal sobre tecnologia, desenvolvimento de software, infraestrutura, hospedagem e serviços digitais. O resultado deve parecer escrito por alguém que trabalha com tecnologia há anos: claro, específico, sem excesso de marketing ou frases prontas.

O site pertence a Paulo Bezerra, desenvolvedor desde 2008 e Tech Lead. Essa informação pode orientar o nível técnico do texto, **mas nunca autoriza inventar experiências, testes, ferramentas utilizadas ou opiniões pessoais dele**.

Os artigos são armazenados em `content/posts/` e renderizados pelo PHP a partir de arquivos `.md`. O objetivo desta skill é **criar ou editar conteúdo**, não mudar a arquitetura, o design ou o código do site.

## 1. Antes de escrever

1. Leia o pedido e identifique o leitor, a dúvida que ele quer resolver e a conclusão prática que o artigo deve entregar.
2. Verifique, quando disponíveis, o `README.md`, os artigos existentes e as categorias já utilizadas. Adapte o conteúdo às convenções reais do repositório. O exemplo abaixo é a referência mínima de formato.
3. Se houver artigo relacionado, evite reescrever a mesma coisa com outro título. Prefira um ângulo novo ou atualizar o artigo existente.
4. Para preços, planos, limites de serviços, políticas de provedores, disponibilidade ou comparações atuais, consulte fontes oficiais e recentes **quando houver acesso à pesquisa**. Se não houver, não invente nem apresente como atuais informações não verificadas.
5. Se faltar apenas um detalhe secundário, faça uma escolha conservadora e continue. Só peça esclarecimento se a resposta mudar substancialmente o conteúdo.

## 2. Voz e estilo

Escreva em **português brasileiro**, de maneira natural, direta e sóbria.

- Comece pela dúvida real do leitor, não por uma introdução genérica sobre a importância da tecnologia.
- Use frases simples e exemplos concretos; explique termos técnicos apenas quando necessário.
- Prefira parágrafos curtos, sem transformar tudo em listas.
- Dê contexto, critérios de decisão e limitações. Quando a resposta for “depende”, explique **do que depende**.
- Use opinião editorial apenas quando houver uma base clara e não atribua uma experiência a Paulo que ele não relatou.
- O texto pode usar primeira pessoa quando fizer sentido, mas evite inventar frases como “eu testei”, “eu uso” ou “na minha experiência”.
- Não escreva para preencher uma contagem de palavras. Como referência, artigos práticos costumam ter 500 a 1.000 palavras; textos curtos podem ser menores e comparativos fundamentados podem ser maiores.

**Evite expressões com aparência de texto gerado por IA**, como:

- “No mundo digital de hoje...”
- “Neste artigo, vamos explorar...”
- “Se você está em busca da solução perfeita, chegou ao lugar certo.”
- “Descubra tudo o que você precisa saber...”
- “Uma solução robusta, poderosa e revolucionária.”
- “Em conclusão, a escolha ideal depende das suas necessidades específicas.”

Evite também clichês comerciais, tom de vendedor, entusiasmo artificial, exagero de negritos, emojis e perguntas retóricas em sequência.

## 3. Formato obrigatório do arquivo

Cada post é **um único `.md`**, salvo em:

`content/posts/<slug>.md`

O `slug` deve ser curto, em minúsculas, sem acentos e separado por hífens. Não altere a lógica de rotas do projeto.

Use **exatamente os campos de metadados presentes no exemplo fornecido**. O formato de `tags` é uma sequência separada por vírgulas, não uma lista YAML:

```markdown
---
title: Como escolher uma hospedagem para WordPress
description: Um roteiro prático para comparar recursos, limites e suporte antes de contratar uma hospedagem.
date: 2026-11-16
category: Hospedagem
tags: wordpress, hospedagem, sites
cover: /assets/images/como-escolher-uma-hospedagem-para-wordpress.svg
published: false
---

# Como escolher uma hospedagem para WordPress

Escolher uma hospedagem começa por entender o que o site precisa hoje e como pode crescer.

## O que comparar

- **Recursos e limites:** armazenamento, tráfego e restrições relevantes.
- **Backups:** frequência e possibilidade de restauração.
- **Renovação:** custo após o período promocional.

## Como decidir

Compare primeiro os requisitos obrigatórios e confirme as condições atuais no site do provedor.
```

O parser em `src/Posts.php` lê pares `campo: valor` em uma única linha; não use valores YAML multilinha ou estruturas aninhadas. Para validar a capa `/assets/images/<slug>.svg`, confira o arquivo `public/assets/images/<slug>.svg`.

Regras dos metadados:

| Campo | Regra |
| --- | --- |
| `title` | Título claro e específico, coerente com o H1 |
| `description` | Resumo natural do benefício do artigo; cerca de 120–160 caracteres quando possível |
| `date` | Data real de publicação ou atualização solicitada; em novo rascunho, usar a data atual conhecida do ambiente |
| `category` | Categoria consistente com as já existentes; preferir `Hospedagem` para esse tema |
| `tags` | De 2 a 5 termos úteis, separados por vírgula |
| `cover` | Para novos posts, caminho da capa SVG própria `/assets/images/<slug>.svg`, **existente** em `public/assets/images/<slug>.svg`; não usar a capa padrão |
| `published` | `false` para novos rascunhos; `true` apenas quando o usuário pedir publicação ou aprovar expressamente |

Preserve a data original ao **revisar** um artigo, a menos que o usuário peça outra coisa ou a convenção do projeto diga o contrário. Não adicione campos novos ao front matter sem confirmar que o parser os aceita.

### Capa SVG obrigatória para novos posts

- Para **cada novo post**, gere uma imagem SVG original, variando aleatoriamente cores, formas e posições, com uma composição coerente com o tema do artigo.
- Crie o arquivo vetorial diretamente em `public/assets/images/<slug>.svg`, com `width="1200"`, `height="470"` e `viewBox="0 0 1200 470"`, sem scripts ou dependências externas.
- Aponte `cover` para `/assets/images/<slug>.svg`. Não reutilize `/assets/images/og-cover.svg` nem apenas copie a capa padrão com outro nome.
- Destaque a **ilustração**, com elementos gráficos grandes e relacionados ao tema, boa margem e contraste. Não inclua textos visíveis: título, tópico, categoria, nome do autor, endereço do site ou rodapé. Use `<title>` e `<desc>` para descrições acessíveis quando necessário, sem exibi-las na composição.
- Use `public/assets/images/dominio-registro-br-onde-hospedar.svg` como referência visual aprovada: ilustração vetorial sobre fundo escuro, sem texto. Preserve essa direção visual, criando uma composição própria para cada tema.
- Respeite o espaço do layout existente. Atualmente, a capa do artigo ocupa até 1120 px de largura e tem `max-height: 440px` com `object-fit: cover`; uma imagem de 1200 × 630 sofre recorte vertical. O formato 1200 × 470 fica com aproximadamente 439 px de altura nessa largura. Não altere CSS ou templates para acomodar a capa.
- Valide o SVG e confira sua renderização e o encaixe nas dimensões usadas pelo layout, inclusive em telas menores. Garanta que os elementos principais não sejam cortados; se o layout mudar, confira seus limites antes de escolher as dimensões.
- Em revisões de posts existentes, preserve a capa, salvo pedido de substituição.

## 4. Estrutura do texto

- Um único `#` (H1), idêntico ao `title`, para que o parser remova o título do corpo e o template não duplique o H1.
- Abertura com dois ou três parágrafos no máximo, que entrem no problema.
- Subseções em `##`; use `###` apenas se necessário.
- Listas para critérios e passos; tabelas **somente quando facilitarem comparações**.
- Conclusão breve, com uma decisão prática ou condição clara para escolher.
- Links descritivos, nunca “clique aqui”.
- Sem HTML bruto, scripts, iframes, shortcodes ou componentes inventados.
- Não insira sumário, FAQ, imagem, estatística ou tabela apenas para aparentar otimização SEO.
- Evite blocos de texto que só repetem palavras-chave.

Se um assunto tiver vários caminhos, mostre os principais trade-offs. Um bom artigo deve ajudar o leitor a **tomar uma decisão**, não apenas repetir descrições de produtos.

## 5. SEO sem artificialidade

- Identifique a intenção principal da busca e responda logo no início.
- Use termos de busca naturalmente no título, na descrição e em pelo menos uma seção quando fizer sentido.
- Não faça repetição mecânica de palavras-chave.
- Não invente dados estruturados, avaliações, estrelas, certificados, benchmarks ou experiências de usuário.
- Não mencione “melhores de 2026” ou outro ano sem que os dados tenham sido conferidos para aquele período.
- Evite títulos sensacionalistas e promessas como “o melhor absoluto”.
- Não crie artigos quase iguais para variações mínimas de palavras-chave.

## 6. Pesquisa, precisão e comparativos

Em qualquer comparação de serviços de hospedagem:

- Diferencie **hospedagem compartilhada**, **VPS**, **cloud** e **serviço gerenciado** quando for importante.
- Verifique se CPU, RAM, disco, backups, SSL, tráfego, suporte e gerenciamento são incluídos ou vendidos separadamente.
- Especifique se o preço é promocional, mensal, de renovação ou condicionado a pagamento antecipado, quando houver comprovação.
- Não atribua velocidade, uptime, qualidade de suporte ou ranking como resultados de teste se ninguém os testou.
- Não transforme uma afirmação publicitária do fornecedor em fato independente.
- Não declare uma empresa como “a melhor” apenas porque oferece comissão maior.
- Se dados comparáveis não estiverem disponíveis, explique a limitação e compare características verificáveis.

Para conteúdo factual e sensível ao tempo, prefira fontes oficiais dos fornecedores e documentação técnica. Insira links de referência úteis no próprio Markdown quando pertinentes. Se a pesquisa não puder ser feita, sinalize pontos pendentes de verificação fora do artigo ou no relatório de entrega; **não publique valores como se fossem confirmados**.

## 7. Links internos e monetização

O site tem a página principal de comparação:

`/melhores-hospedagens`

Ela reúne recomendações de **hospedagem compartilhada e VPS**, com eventuais links de afiliados cadastrados separadamente.

- Todo artigo deve ser compatível com o **CTA global já adicionado pelo template** no final dos posts.
- **Não repita no Markdown o bloco “Procurando uma hospedagem para seu projeto?”** ou outro CTA global.
- Quando o assunto realmente se relacionar a contratação, tipos ou escolha de hospedagem, inclua **no corpo do artigo, no máximo um link interno contextual** para `/melhores-hospedagens`. Exemplo: “Se você já decidiu contratar, [compare as opções de hospedagem](/melhores-hospedagens).”
- Não force link para hospedagem em artigos que tratem de assuntos sem relação. O CTA global já cumpre a exigência de levar o leitor à página comercial.
- Não coloque URLs de afiliados inventadas ou placeholders que se pareçam com links reais.
- Se for necessário um link comercial direto, peça ao projeto a URL aprovada ou utilize somente a que já estiver cadastrada e identifique o conteúdo patrocinado conforme a implementação do site.
- Não disfarce anúncios como testes pessoais ou recomendações independentes.
- Não altere o ranking, seus dados ou links de afiliados ao escrever um artigo, salvo pedido explícito.

## 8. Fluxo de entrega

Ao receber um tema:

1. Defina um ângulo específico: que pergunta o post responde?
2. Confira o conteúdo já existente no projeto e, se necessário, dados externos atuais.
3. Escreva o texto com o front matter e as seções descritas acima. Para novos posts, gere também a capa SVG própria e preencha `cover` com seu caminho.
4. Revise para remover frases genéricas, redundâncias, exageros e alegações não verificadas.
5. Confira se o `slug`, as imagens, os links internos e o YAML estão válidos.
6. Salve o arquivo em `content/posts/<slug>.md` se estiver trabalhando diretamente no repositório; caso contrário, entregue o Markdown completo e, para novos posts, o SVG completo com seu caminho para salvar.
7. Informe sucintamente o nome do arquivo e quais fatos ou links ainda exigem validação. Não afirme que publicou no site se apenas criou um arquivo local.

**Não altere código PHP, CSS, layouts ou arquivos de outros artigos. Não gere múltiplos posts quando o pedido for de apenas um.**

## 9. Checklist antes de finalizar

- [ ] O texto tem um objetivo claro e responde a uma dúvida real?
- [ ] Soa como alguém escrevendo normalmente, sem frases de apresentação de IA?
- [ ] O front matter contém os sete campos esperados e o título corresponde ao H1?
- [ ] Cada novo post tem uma capa SVG própria, gerada com variação aleatória, validada e referenciada em `cover`, sem usar a capa padrão?
- [ ] O artigo está com `published: false` se ainda é rascunho?
- [ ] Preços, números, recomendações e afirmações técnicas foram verificados ou qualificados?
- [ ] Não há testes, opiniões pessoais ou experiências atribuídas ao autor sem evidência?
- [ ] O link para `/melhores-hospedagens` aparece apenas quando é contextual?
- [ ] O CTA automático do template não foi duplicado?
- [ ] O arquivo pode entrar no projeto sem mudanças no PHP?
