(() => {
  const root = document.querySelector('#hosting-wizard');
  if (!root) return;
  const catalog = JSON.parse(document.querySelector('#wizard-catalog').textContent);
  const bySlug = Object.fromEntries(catalog.map(item => [item.slug, item]));
  const objectiveOptions = [
    ['site', 'Criar ou publicar um site'], ['wordpress', 'Usar WordPress'],
    ['app', 'Hospedar uma aplicação'], ['resell', 'Revender hospedagem'],
    ['automation', 'Executar automações ou ferramentas de IA'], ['specific', 'Buscar uma ferramenta específica']
  ];
  const questions = [
    { key: 'objective', title: 'Qual é seu objetivo?', options: objectiveOptions },
    { key: 'need', title: 'Qual necessidade descreve melhor o que você procura?', options: [] },
    { key: 'admin', title: 'Há alguém que possa administrar tecnicamente um servidor?', options: [['yes', 'Sim, eu ou minha equipe cuidaremos disso'], ['no', 'Não temos responsável técnico'], ['unsure', 'Ainda não sabemos']] }
  ];
  const needOptions = {
    site: [['visual', 'Quero criar o site com uma ferramenta'], ['host', 'Já tenho ou vou desenvolver o site e preciso hospedá-lo']],
    wordpress: [['wordpress', 'Hospedagem identificada para WordPress']],
    app: [['server', 'Preciso de controle e configuração próprios em uma VPS'], ['dedicated', 'Quero avaliar um servidor dedicado'], ['managed', 'Prefiro uma solução gerenciada ou ainda não sei dimensionar']],
    resell: [['resell', 'Quero oferecer hospedagem a clientes']],
    automation: [['n8n', 'n8n'], ['openclaw', 'OpenClaw'], ['gatorclaw', 'GatorClaw']],
    specific: [['evolution-go', 'Evolution Go'], ['evolution-api', 'Evolution API'], ['evolution-crm', 'Evolution CRM'], ['allpass', 'AllPass']]
  };
  const answer = {};
  let step = 0;
  const form = document.querySelector('#wizard-form');
  const field = document.querySelector('#wizard-question');
  const result = document.querySelector('#wizard-result');
  const error = document.querySelector('#wizard-error');
  const back = document.querySelector('#wizard-back');
  const adminObjectives = new Set(['app', 'automation']);
  const activeSteps = () => answer.objective && adminObjectives.has(answer.objective)
    && !(answer.objective === 'app' && answer.need === 'managed')
    ? [questions[0], questions[1], questions[2]] : [questions[0], questions[1]];
  function clearRecommendation() {
    document.querySelectorAll('.provider-card.is-recommended').forEach(card => card.classList.remove('is-recommended'));
    document.querySelectorAll('.recommendation-badge').forEach(badge => { badge.hidden = true; });
  }
  function render(focus = true) {
    result.hidden = true; form.hidden = false; error.textContent = '';
    const list = activeSteps();
    const current = list[step];
    const options = current.key === 'need' ? needOptions[answer.objective] : current.options;
    document.querySelector('#wizard-progress').textContent = `Pergunta ${step + 1} de ${list.length}`;
    field.replaceChildren();
    const legend = document.createElement('legend'); legend.textContent = current.title; legend.tabIndex = -1; field.append(legend);
    options.forEach(([value, labelText]) => {
      const label = document.createElement('label'); const radio = document.createElement('input');
      radio.type = 'radio'; radio.name = 'answer'; radio.value = value; radio.checked = answer[current.key] === value;
      label.append(radio, document.createTextNode(labelText)); field.append(label);
    });
    back.disabled = step === 0;
    document.querySelector('#wizard-next').textContent = step === list.length - 1 ? 'Ver indicação →' : 'Continuar →';
    if (focus) legend.focus();
  }
  function recommendation() {
    const {objective, need, admin} = answer;
    let slug;
    if (objective === 'site') slug = need === 'visual' ? 'criador-sites' : 'hospedagem-sites';
    else if (objective === 'wordpress') slug = 'hospedagem-wordpress';
    else if (objective === 'resell') slug = 'revenda';
    else if (objective === 'app') slug = need === 'dedicated' ? 'servidor-dedicado' : 'servidor-vps';
    else if (objective === 'automation') slug = ({n8n:'vps-n8n',openclaw:'vps-openclaw',gatorclaw:'vps-gatorclaw'})[need];
    else slug = need;
    return bySlug[slug];
  }
  function showResult() {
    const inconclusive = answer.objective === 'app' && answer.need === 'managed';
    const link = document.querySelector('#wizard-service-link');
    if (inconclusive) {
      document.querySelector('#wizard-result-title').textContent = 'Ainda não há informação suficiente para indicar um serviço';
      document.querySelector('#wizard-reason').textContent = 'Defina os requisitos da aplicação e quem administrará o ambiente antes de contratar.';
      document.querySelector('#wizard-caution').textContent = 'Uma solução gerenciada precisa ser confirmada com o fornecedor conforme os requisitos do projeto.';
      link.hidden = true;
      form.hidden = true; result.hidden = false;
      document.querySelector('#wizard-progress').textContent = 'Orientação';
      document.querySelector('#wizard-result-title').focus();
      return;
    }
    const item = recommendation();
    const adminMissing = (answer.objective === 'app' || answer.objective === 'automation') && answer.admin !== 'yes';
    document.querySelector('#wizard-result-title').textContent = item.name;
    document.querySelector('#wizard-reason').textContent = adminMissing
      ? `Entre os serviços listados, ${item.name} é uma opção para avaliar para o objetivo indicado (${item.purpose.toLowerCase()}). Isso não significa que seja uma solução sem manutenção nem confirma compatibilidade.`
      : `Pelas suas respostas, ${item.name} é o serviço mais próximo do objetivo indicado: ${item.purpose.toLowerCase()}.`;
    document.querySelector('#wizard-caution').textContent = adminMissing
      ? `Atenção: serviços de servidor podem exigir administração técnica contínua. Você informou que não há responsável técnico ou que isso ainda não está definido. Não considere VPS uma solução sem manutenção. Confirme com a HostGator o que é gerenciado e quem cuida de atualizações, segurança, backups e monitoramento. ${item.care}`
      : `${item.care} Confirme compatibilidade e condições atuais diretamente com a HostGator.`;
    link.hidden = false; link.href = `#service-${item.slug}`;
    form.hidden = true; result.hidden = false; document.querySelector('#wizard-progress').textContent = 'Indicação para avaliação';
    document.querySelector('#wizard-result-title').focus();
  }
  form.addEventListener('submit', event => {
    event.preventDefault();
    const selected = field.querySelector('input:checked');
    if (!selected) { error.textContent = 'Escolha uma opção para continuar.'; field.querySelector('input')?.focus(); return; }
    const current = activeSteps()[step]; answer[current.key] = selected.value;
    if (current.key === 'objective') {
      const onlyNeed = needOptions[answer.objective];
      if (onlyNeed.length === 1) {
        answer.need = onlyNeed[0][0];
        showResult();
        return;
      }
    }
    if (answer.objective === 'app' && answer.need === 'managed') {
      showResult();
      return;
    }
    if (step === activeSteps().length - 1) showResult(); else { step++; render(); }
  });
  back.addEventListener('click', () => { if (step > 0) { step--; render(); } });
  document.querySelector('#wizard-restart').addEventListener('click', () => { clearRecommendation(); Object.keys(answer).forEach(key => delete answer[key]); step = 0; render(); });
  document.querySelector('#wizard-service-link').addEventListener('click', event => {
    const card = document.querySelector(event.currentTarget.getAttribute('href'));
    if (!card) return;
    clearRecommendation(); card.classList.add('is-recommended');
    const badge = card.querySelector('.recommendation-badge'); if (badge) badge.hidden = false;
    card.scrollIntoView({behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth', block: 'start'});
    card.focus({preventScroll: true});
  });
  root.hidden = false; render(false);
})();
