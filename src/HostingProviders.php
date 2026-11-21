<?php
declare(strict_types=1);

/** Catálogo dos 13 serviços HostGator listados em docs/hostgator-afiliados.md. */
function hostingProviders(): array
{
    return [
        'sites' => [
            ['slug'=>'hospedagem-sites','name'=>'Hospedagem de Sites','category'=>'sites','description'=>'Serviço de hospedagem para publicar sites e projetos web. Consulte os recursos e limites do plano atual.','profile'=>'Quem quer colocar um site ou blog no ar sem administrar um servidor completo.','purpose'=>'Hospedar um site ou blog','care'=>'Confirme limites, e-mail, backups, migração, ciclo de cobrança e renovação.'],
            ['slug'=>'criador-sites','name'=>'Criador de Sites','category'=>'sites','description'=>'Ferramenta visual para montar e publicar um site.','profile'=>'Quem prefere montar um site com uma ferramenta de criação incluída.','purpose'=>'Criar e publicar um site com ferramenta visual','care'=>'Verifique modelos, recursos de edição, domínio, exportação e o que ocorre se cancelar.'],
            ['slug'=>'hospedagem-wordpress','name'=>'Hospedagem WordPress','category'=>'sites','description'=>'Hospedagem identificada para projetos que usam WordPress.','profile'=>'Quem pretende publicar ou manter um site baseado em WordPress.','purpose'=>'Hospedar um site WordPress','care'=>'Confirme versões, plugins permitidos, migração, backups e responsabilidades de atualização.'],
        ],
        'infraestrutura' => [
            ['slug'=>'servidor-vps','name'=>'Servidor VPS','category'=>'infraestrutura','description'=>'Servidor virtual para projetos que precisam avaliar configuração e administração do ambiente.','profile'=>'Projetos com responsável técnico para configurar e manter o servidor.','purpose'=>'Hospedar uma aplicação com controle do servidor','care'=>'Exige responsável por sistema operacional, segurança, atualizações, backups e monitoramento.'],
            ['slug'=>'servidor-dedicado','name'=>'Servidor Dedicado','category'=>'infraestrutura','description'=>'Serviço de servidor dedicado; configuração, gestão e capacidade devem ser confirmadas com o fornecedor.','profile'=>'Projetos que precisam avaliar recursos de servidor dedicado com equipe técnica.','purpose'=>'Avaliar servidor dedicado','care'=>'Confirme recursos, gestão incluída, suporte, rede, backup e custo total.'],
            ['slug'=>'revenda','name'=>'Revenda','category'=>'infraestrutura','description'=>'Solução de revenda de hospedagem para quem pretende oferecer serviços de hospedagem a clientes.','profile'=>'Profissionais ou empresas que querem operar uma oferta própria de hospedagem.','purpose'=>'Revender hospedagem','care'=>'Confirme limites, administração de contas, suporte aos seus clientes e condições comerciais.'],
        ],
        'automacao' => [
            ['slug'=>'vps-n8n','name'=>'VPS com n8n','category'=>'automacao','description'=>'Servidor VPS com o n8n instalado para criar fluxos de automação entre serviços e aplicações.','profile'=>'Quem quer automatizar fluxos com n8n e tem responsável pela operação do servidor e dos fluxos.','purpose'=>'Executar automações com n8n','care'=>'O plano oferece acesso root; gerenciamento do n8n, fluxos e backups é responsabilidade do cliente. Verifique domínio/HTTPS, segurança e rotinas de recuperação.'],
            ['slug'=>'vps-openclaw','name'=>'VPS com OpenClaw','category'=>'automacao','description'=>'Oferta de VPS com OpenClaw para configurar agentes de IA e automações.','profile'=>'Quem busca especificamente avaliar OpenClaw em servidor e entende as permissões e integrações que pretende configurar.','purpose'=>'Avaliar OpenClaw em servidor','care'=>'Confirme sistema operacional, configuração da oferta, chaves de API e segurança de tokens e integrações; confira quem mantém o ambiente.'],
            ['slug'=>'vps-gatorclaw','name'=>'VPS com GatorClaw','category'=>'automacao','description'=>'Oferta de VPS com GatorClaw, uma interface de automação baseada em IA para configurar agentes e integrações.','profile'=>'Quem busca especificamente avaliar GatorClaw em servidor e pode assumir a operação técnica.','purpose'=>'Avaliar GatorClaw','care'=>'A documentação caracteriza o GatorClaw como auto-hospedado e atribui ao cliente manutenção, segurança e integridade dos dados. Confirme os termos e requisitos atuais.'],
        ],
        'outras' => [
            ['slug'=>'evolution-go','name'=>'Evolution Go','category'=>'outras','description'=>'Aplicação baseada em Go para automações, bots e integrações com múltiplas instâncias de WhatsApp em VPS.','profile'=>'Quem está buscando especificamente automações e integrações com Evolution Go.','purpose'=>'Buscar Evolution Go para bots, automações e integrações de WhatsApp','care'=>'Confirme o modelo de conexão do WhatsApp, volume suportado, configuração e requisitos técnicos.'],
            ['slug'=>'evolution-api','name'=>'Evolution API','category'=>'outras','description'=>'Aplicação para integrar sistemas, bots e automações ao WhatsApp e criar fluxos personalizados.','profile'=>'Quem precisa integrar aplicações ou automações e tem conhecimento de APIs, autenticação e webhooks.','purpose'=>'Buscar Evolution API para integrações e automações','care'=>'A configuração inicial e a manutenção de integrações exigem conhecimento técnico. Confirme requisitos, autenticação e modelo de uso do WhatsApp.'],
            ['slug'=>'evolution-crm','name'=>'Evolution CRM','category'=>'outras','description'=>'Oferta de VPS com Evolution CRM para organizar atendimento e conversas em canais como WhatsApp.','profile'=>'Quem busca especificamente uma ferramenta de CRM e atendimento com automações.','purpose'=>'Buscar Evolution CRM para organizar atendimento','care'=>'Confirme canais suportados, recursos incluídos, configuração, privacidade e condições atuais.'],
            ['slug'=>'allpass','name'=>'AllPass','category'=>'outras','description'=>'Assinatura de ferramentas de inteligência artificial acessadas em uma plataforma.','profile'=>'Quem busca acesso a ferramentas de IA em uma assinatura HostGator.','purpose'=>'Buscar AllPass para acessar ferramentas de IA','care'=>'Confira ferramentas disponíveis, limites de uso justo, modelos, ciclos de cobrança e disponibilidade.'],
        ],
    ];
}

function hostingAffiliateLinks(): array
{
    return [
        'hospedagem-sites'=>'https://www.hostgator.com.br/53582-77-3-32.html',
        'criador-sites'=>'https://www.hostgator.com.br/53582-78-3-33.html',
        'hospedagem-wordpress'=>'https://www.hostgator.com.br/53582-128-3-36.html',
        'servidor-vps'=>'https://www.hostgator.com.br/53582-13-3-12.html',
        'servidor-dedicado'=>'https://www.hostgator.com.br/53582-2-3-11.html',
        'revenda'=>'https://www.hostgator.com.br/53582-126-3-34.html',
        'vps-n8n'=>'https://www.hostgator.com.br/53582-137-3-46.html',
        'vps-openclaw'=>'https://www.hostgator.com.br/53582-141-3-52.html',
        'vps-gatorclaw'=>'https://www.hostgator.com.br/53582-142-3-53.html',
        'evolution-go'=>'https://www.hostgator.com.br/53582-144-3-55.html',
        'evolution-api'=>'https://www.hostgator.com.br/53582-145-3-56.html',
        'evolution-crm'=>'https://www.hostgator.com.br/53582-146-3-58.html',
        'allpass'=>'https://www.hostgator.com.br/53582-147-3-59.html',
    ];
}
