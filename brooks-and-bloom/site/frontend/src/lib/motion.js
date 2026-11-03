/** Small, purposeful motion and navigation behaviour. Respects reduced-motion via CSS. */

export function initHeader() {
  const header = document.querySelector('[data-site-header]');
  const cta = document.querySelector('[data-mobile-cta]');
  if (!header) return;
  let lastY = window.scrollY;
  let ticking = false;
  const update = () => {
    const y = window.scrollY;
    header.classList.toggle('is-scrolled', y > 24);
    // Hide when reading down, return as soon as the visitor scrolls up
    header.classList.toggle('is-hidden', y > 480 && y > lastY + 4);
    if (y < lastY - 4 || y < 480) header.classList.remove('is-hidden');
    cta?.classList.toggle('is-visible', y > window.innerHeight * 0.7);
    lastY = y;
    ticking = false;
  };
  window.addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(update); } }, { passive: true });
  update();
}

/** Only elements below the fold on load are staged, so the first frame is always complete. */
export function initReveal(root = document) {
  const els = [...root.querySelectorAll('.reveal:not(.is-revealed)')];
  if (!('IntersectionObserver' in window)) return;
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (!e.isIntersecting) return;
      e.target.classList.remove('is-staged');
      e.target.classList.add('is-revealed');
      io.unobserve(e.target);
    });
  }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
  const fold = window.innerHeight;
  els.forEach((el) => {
    const r = el.getBoundingClientRect();
    if (r.top < fold && r.bottom > 0) { el.classList.add('is-revealed'); return; }
    if (r.height === 0) return; // hidden view in the preview; staged when shown
    el.classList.add('is-staged');
    io.observe(el);
  });
}

export function initDrawPaths() {
  document.querySelectorAll('.draw path').forEach((p) => p.style.setProperty('--len', Math.ceil(p.getTotalLength()) + 1));
}

export function initToTop() {
  document.addEventListener('click', (e) => {
    const a = e.target.closest('[data-to-top]');
    if (!a) return;
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

/** Single-file preview: each page is a <main data-view>, switched by #hash. */
export function initPreviewViews() {
  const views = [...document.querySelectorAll('[data-view]')];
  if (!views.length) return;
  const show = (scroll) => {
    const raw = location.hash.slice(1);
    // Unknown hashes (in-page anchors) leave the current view alone
    if (raw && !views.some((v) => v.dataset.view === raw)) return;
    const name = raw || 'home';
    views.forEach((v) => { v.hidden = v.dataset.view !== name; });
    document.querySelectorAll('[data-nav]').forEach((a) => {
      if (a.dataset.nav === name) a.setAttribute('aria-current', 'page'); else a.removeAttribute('aria-current');
    });
    const view = views.find((v) => v.dataset.view === name);
    window.dispatchEvent(new CustomEvent('bb:view', { detail: name }));
    if (scroll) window.scrollTo({ top: 0 });
    requestAnimationFrame(() => { initReveal(view); initDrawPaths(); });
  };
  window.addEventListener('hashchange', () => show(true));
  show(false);
}
