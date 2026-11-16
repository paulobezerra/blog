(() => {
  const root = document.querySelector('#hosting-wizard');
  if (!root) return;
  const catalog = JSON.parse(document.querySelector('#wizard-catalog').textContent);
  const questions = [
    ['O que você quer colocar no ar?', [['site', 'Blog, WordPress ou site institucional'], ['store', 'Loja virtual'], ['app', 'Aplicação com Docker, processos contínuos ou configuração própria']]],
    ['Quem pode administrar um servidor?', [['no', 'Quero que o serviço cuide da infraestrutura'], ['yes', 'Eu ou minha equipe cuidamos de atualizações, segurança e backups']]],
    ['Como é a demanda do projeto?', [['small', 'Está começando, com uso pequeno ou previsível'], ['high', 'Já tem uso intenso, picos ou operação crítica'], ['unknown', 'Ainda não sei dimensionar']]],
    ['Como está o domínio?', [['existing', 'Já tenho um domínio'], ['new', 'Preciso registrar e posso avaliar um contrato anual'], ['monthly', 'Preciso registrar, mas prefiro evitar pagamento anual antecipado']]],
  ];
  const answers = [];
  let step = 0;
  const form = document.querySelector('#wizard-form');
  const field = document.querySelector('#wizard-question');
  const result = document.querySelector('#wizard-result');
  const error = document.querySelector('#wizard-error');
  const back = document.querySelector('#wizard-back');
  function render(focus = true) {
    result.hidden = true;
    form.hidden = false;
    error.textContent = '';
    document.querySelector('#wizard-progress').textContent = `Pergunta ${step + 1} de ${questions.length}`;
    field.replaceChildren();
    const legend = document.createElement('legend');
    legend.textContent = questions[step][0];
    legend.tabIndex = -1;
    field.append(legend);
    questions[step][1].forEach(([value, text]) => {
      const label = document.createElement('label');
      const radio = document.createElement('input');
      radio.type = 'radio'; radio.name = 'answer'; radio.value = value;
      radio.checked = answers[step] === value;
      label.append(radio, document.createTextNode(text));
      field.append(label);
    });
    back.disabled = step === 0;
    document.querySelector('#wizard-next').textContent = step === 3 ? 'Ver indicação →' : 'Continuar →';
    if (focus) legend.focus();
  }
  function showResult() {
    const [project, admin, demand, domain] = answers;
    const custom = project === 'app';
    const demanding = demand !== 'small' || project === 'store';
    let title, reason, providers;
    if (custom && admin === 'no') {
      title = 'Procure uma plataforma de aplicações gerenciada';
      reason = 'Sua aplicação exige configuração própria, mas você não quer administrar servidores. Confirme suporte à linguagem, processos, banco de dados e deploy. O catálogo atual não tem uma indicação validada para essa combinação.';
      providers = [];
    } else if (admin === 'yes' && (custom || demanding)) {
      title = 'Avalie uma VPS com administração própria';
      reason = 'Seu perfil permite manter um servidor e pede avaliação de recursos ou configuração própria. Dimensione CPU, memória e armazenamento antes de escolher o plano.';
      providers = catalog.filter(p => p.category === 'vps' && p.slug !== 'cloudways');
    } else if (demanding) {
      title = 'Avalie hospedagem gerenciada com dimensionamento';
      reason = 'Uma loja, demanda elevada ou ainda desconhecida pede avaliação técnica. Procure suporte para sua plataforma e confirme quem cuida dos backups, atualizações e capacidade. Cloudways é uma opção do catálogo a investigar, sujeita à compatibilidade do projeto.';
      providers = catalog.filter(p => p.slug === 'cloudways');
    } else {
      title = 'Comece avaliando hospedagem compartilhada';
      reason = 'Para um blog ou site pequeno com uso previsível, um ambiente com infraestrutura administrada pode atender sem exigir a manutenção de uma VPS. Compare os limites do plano com seu site.';
      providers = catalog.filter(p => p.category === 'compartilhada');
    }
    document.querySelector('#wizard-result-title').textContent = title;
    document.querySelector('#wizard-reason').textContent = reason;
    const checks = [
      'Compare o total pago hoje, a renovação e os extras no mesmo período. O menor valor mensal pode exigir anos de pagamento antecipado.',
      'Confirme limites, SSL, e-mail, suporte, frequência dos backups e custo de restauração.',
      domain === 'existing' ? 'Use seu domínio atual. Não presuma que uma oferta de registro grátis cobre renovação ou transferência.' : domain === 'monthly' ? 'Compare registro separado e planos com cobrança mensal. Não conte com domínio grátis sem conferir as condições do ciclo.' : 'Domínio incluído só desempata planos que já atendem ao projeto. Confira extensão, prazo de resgate e renovação; não contrate recursos desnecessários pelo benefício.',
    ];
    const list = document.querySelector('#wizard-checks'); list.replaceChildren();
    checks.forEach(text => { const li = document.createElement('li'); li.textContent = text; list.append(li); });
    const cards = document.querySelector('#wizard-providers'); cards.replaceChildren();
    providers.forEach(p => {
      const card = document.createElement('article'); card.className = 'provider-card';
      const heading = document.createElement('h3'); heading.textContent = p.name;
      const note = document.createElement('p'); note.textContent = p.affiliate ? 'Link patrocinado: o site pode receber comissão pela contratação.' : 'Link oficial, sem afiliação cadastrada.';
      const link = document.createElement('a'); link.className = 'button-link';
      link.textContent = `Consultar planos de ${p.name}`;
      link.href = p.affiliate || p.official;
      link.rel = p.affiliate ? 'sponsored nofollow noopener' : 'noopener';
      card.append(heading, note, link); cards.append(card);
    });
    form.hidden = true; result.hidden = false;
    document.querySelector('#wizard-progress').textContent = 'Sua indicação';
    document.querySelector('#wizard-result-title').focus();
  }
  form.addEventListener('submit', event => {
    event.preventDefault();
    const selected = field.querySelector('input:checked');
    if (!selected) { error.textContent = 'Escolha uma opção para continuar.'; field.querySelector('input').focus(); return; }
    answers[step] = selected.value;
    if (step === questions.length - 1) showResult(); else { step++; render(); }
  });
  back.addEventListener('click', () => {
    answers[step] = field.querySelector('input:checked')?.value;
    if (step > 0) { step--; render(); }
  });
  document.querySelector('#wizard-restart').addEventListener('click', () => { answers.length = 0; step = 0; render(); });
  root.hidden = false;
  render(false);
})();
