import { useCallback, useEffect, useState } from 'react';
import { createPortal } from 'react-dom';
import { Icon, useDialog, usePresence } from '../lib/ui.jsx';

export default function MobileNav({ links, current, bookingUrl, email, instagram }) {
  const [open, setOpen] = useState(false);
  const [active, setActive] = useState(current);
  const close = useCallback(() => setOpen(false), []);
  const ref = useDialog(open, close);
  const { mounted, visible } = usePresence(open, 500);

  useEffect(() => {
    const onView = (e) => setActive(e.detail);
    window.addEventListener('bb:view', onView);
    return () => window.removeEventListener('bb:view', onView);
  }, []);

  return (
    <>
      <button type="button" onClick={() => setOpen(true)} aria-expanded={open} aria-controls="mobile-menu"
        className="inline-flex h-12 w-12 items-center justify-center rounded-full text-ink transition-colors hover:bg-ink/5">
        <Icon name="menu" className="icon h-6 w-6" /><span className="sr-only">Open menu</span>
      </button>
      {mounted && createPortal(
        <div id="mobile-menu" ref={ref} role="dialog" aria-modal="true" aria-label="Menu"
          className={`fixed inset-0 z-[70] flex flex-col overflow-y-auto bg-ivory transition-[opacity,clip-path] duration-500 ease-soft ${visible ? 'opacity-100 [clip-path:circle(150%_at_calc(100%-40px)_40px)]' : 'opacity-0 [clip-path:circle(0%_at_calc(100%-40px)_40px)]'}`}
          style={{ paddingTop: 'env(safe-area-inset-top, 0px)', paddingBottom: 'env(safe-area-inset-bottom, 0px)' }}>
          <span className="wash wash-lavender -right-20 top-24 h-72 w-72" aria-hidden="true" />
          <span className="wash wash-sage -left-24 bottom-24 h-64 w-64" aria-hidden="true" />
          <div className="wrap relative flex h-[76px] shrink-0 items-center justify-between">
            <span className="font-display text-xl uppercase tracking-[.22em] text-taupe-deep">Brooks &amp; Bloom</span>
            <button type="button" onClick={close} className="inline-flex h-12 w-12 items-center justify-center rounded-full border border-line text-ink">
              <Icon name="close" className="icon h-6 w-6" /><span className="sr-only">Close menu</span>
            </button>
          </div>
          <nav aria-label="Mobile" className="wrap relative flex-1 pt-6">
            <ul className="space-y-1">
              {links.map((l, i) => (
                <li key={l.slug} className={`transition-all duration-700 ease-soft ${visible ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'}`} style={{ transitionDelay: visible ? `${120 + i * 55}ms` : '0ms' }}>
                  <a href={l.href} onClick={close} aria-current={active === l.slug ? 'page' : undefined}
                    className="group flex items-baseline justify-between border-b border-line py-4 font-display text-4xl text-ink">
                    <span className={active === l.slug ? 'italic text-taupe' : ''}>{l.label}</span>
                    <Icon name="arrow-right" className="icon h-5 w-5 text-taupe-deep transition-transform group-hover:translate-x-1" />
                  </a>
                </li>
              ))}
            </ul>
          </nav>
          <div className={`wrap relative space-y-6 py-8 transition-all delay-500 duration-700 ${visible ? 'opacity-100' : 'opacity-0'}`}>
            <a href={bookingUrl} data-book target="_blank" rel="noopener" onClick={close} className="btn btn-primary w-full"><Icon name="calendar" /> Check availability</a>
            <div className="flex items-center justify-center gap-6 text-sm text-ink-soft">
              <a href={instagram} target="_blank" rel="noopener" className="inline-flex items-center gap-2"><Icon name="instagram" className="icon h-4 w-4" /> Instagram</a>
              <a href={`mailto:${email}`} className="inline-flex items-center gap-2"><Icon name="mail" className="icon h-4 w-4" /> Email</a>
            </div>
          </div>
        </div>,
        document.body,
      )}
    </>
  );
}
