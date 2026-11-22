const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('#main-nav');

menuButton?.addEventListener('click', () => {
  const expanded = menuButton.getAttribute('aria-expanded') === 'true';
  menuButton.setAttribute('aria-expanded', String(!expanded));
  navigation?.classList.toggle('is-open', !expanded);
});

document.addEventListener('click', (event) => {
  const link = event.target instanceof Element ? event.target.closest('a[href]') : null;
  if (!link || event.defaultPrevented || typeof gtag !== 'function') return;

  let url;
  try {
    url = new URL(link.href);
  } catch {
    return;
  }

  if (url.hostname !== 'www.hostgator.com.br' ||
      !/^\/53582-\d+-\d+-\d+\.html$/.test(url.pathname)) return;

  gtag('event', 'conversion', {
    send_to: 'AW-18588112608/iqYkCPHn37wdEOCtwJ9F',
    value: 1.0,
    currency: 'BRL',
  });
});
