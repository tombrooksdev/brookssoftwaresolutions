import { useCallback, useEffect, useState } from 'react';
import { Icon, useDialog, usePresence } from '../lib/ui.jsx';

/**
 * Pixieset booking connector. Every element with [data-book] (optionally ="package-slug")
 * opens this drawer. Without JS those links go straight to Pixieset.
 */
export default function BookingDrawer({ packages, bookingUrl, deposit, contactUrl }) {
  const [open, setOpen] = useState(false);
  const [slug, setSlug] = useState(null);
  const close = useCallback(() => setOpen(false), []);
  const ref = useDialog(open, close);
  const { mounted, visible } = usePresence(open, 450);
  const pkg = packages.find((p) => p.slug === slug);

  useEffect(() => {
    const onClick = (e) => {
      const trigger = e.target.closest('[data-book]');
      if (!trigger || e.metaKey || e.ctrlKey || e.shiftKey || e.button === 1) return;
      e.preventDefault();
      setSlug(trigger.dataset.book || null);
      setOpen(true);
    };
    document.addEventListener('click', onClick);
    return () => document.removeEventListener('click', onClick);
  }, []);

  if (!mounted) return null;
  return (
    <div className="fixed inset-0 z-[80]">
      <div className={`absolute inset-0 bg-ink/40 backdrop-blur-[2px] transition-opacity duration-500 ${visible ? 'opacity-100' : 'opacity-0'}`} onClick={close} aria-hidden="true" />
      <div ref={ref} role="dialog" aria-modal="true" aria-labelledby="booking-title"
        className={`absolute inset-x-0 bottom-0 flex max-h-[92dvh] flex-col overflow-hidden rounded-t-[1.75rem] bg-ivory shadow-xl transition-transform duration-500 ease-soft sm:inset-y-0 sm:left-auto sm:right-0 sm:max-h-none sm:w-[28rem] sm:rounded-none sm:rounded-l-[1.75rem] ${visible ? 'translate-y-0 sm:translate-x-0' : 'translate-y-full sm:translate-x-full sm:translate-y-0'}`}
        style={{ paddingBottom: 'env(safe-area-inset-bottom, 0px)', paddingRight: 'env(safe-area-inset-right, 0px)' }}>
        <div className="mx-auto mt-3 h-1 w-10 shrink-0 rounded-full bg-line sm:hidden" aria-hidden="true" />
        <div className="flex items-center justify-between gap-4 border-b border-line px-6 py-5">
          <div>
            <p className="eyebrow">Book a session</p>
            <h2 id="booking-title" className="mt-1 font-display text-3xl">{pkg ? pkg.name : 'Choose your session'}</h2>
          </div>
          <button type="button" onClick={close} className="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-line text-ink hover:border-taupe-deep">
            <Icon name="close" /><span className="sr-only">Close</span>
          </button>
        </div>

        <div className="flex-1 overflow-y-auto px-6 py-6">
          {!pkg ? (
            <ul className="space-y-3">
              {packages.map((p) => (
                <li key={p.slug}>
                  <button type="button" onClick={() => setSlug(p.slug)}
                    className="group flex w-full items-center justify-between gap-4 rounded-2xl border border-line p-5 text-left transition-colors hover:border-taupe-deep hover:bg-surface">
                    <span>
                      <span className="block font-display text-2xl leading-tight">{p.name}</span>
                      <span className="mt-1 block text-sm text-ink-soft">{p.duration} &middot; {p.images} images</span>
                    </span>
                    <span className="flex items-center gap-3"><span className="font-display text-2xl">{p.price}</span><Icon name="chevron-right" className="icon h-5 w-5 text-taupe-deep transition-transform group-hover:translate-x-1" /></span>
                  </button>
                </li>
              ))}
            </ul>
          ) : (
            <div className="space-y-6">
              <div className="rounded-2xl bg-surface p-5">
                <div className="flex items-baseline justify-between gap-4">
                  <span className="text-sm text-ink-soft">From</span>
                  <span className="font-display text-4xl leading-none">{pkg.price}</span>
                </div>
                <p className="mt-3 text-sm leading-relaxed text-ink-soft">{pkg.summary}</p>
                <p className="mt-4 flex flex-wrap gap-x-5 gap-y-1 text-sm">
                  <span className="inline-flex items-center gap-2"><Icon name="clock" className="icon h-4 w-4 text-taupe-deep" />{pkg.duration}</span>
                  <span className="inline-flex items-center gap-2"><Icon name="image" className="icon h-4 w-4 text-taupe-deep" />{pkg.images} edited images</span>
                </p>
              </div>
              <div>
                <h3 className="eyebrow">What happens next</h3>
                <ol className="mt-4 space-y-4 text-sm">
                  {[
                    ['calendar', 'Pick a date and time that suits you in my booking calendar.'],
                    ['shield', `Pay the £${deposit.amount} booking fee securely. It comes off your session price.`],
                    ['mail', 'You get a confirmation email, then my session guide a little closer to the day.'],
                  ].map(([icon, text], i) => (
                    <li key={i} className="flex gap-3">
                      <span className="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-lavender-wash text-taupe-deep"><Icon name={icon} className="icon h-4 w-4" /></span>
                      <span className="pt-2 leading-relaxed">{text}</span>
                    </li>
                  ))}
                </ol>
              </div>
              <button type="button" onClick={() => setSlug(null)} className="link-arrow"><Icon name="chevron-left" /> Choose a different session</button>
            </div>
          )}
        </div>

        <div className="space-y-3 border-t border-line px-6 py-5">
          <a href={pkg ? pkg.url : bookingUrl} target="_blank" rel="noopener" data-autofocus className="btn btn-primary w-full">
            <Icon name="calendar" /> {pkg ? 'Continue to booking calendar' : 'See all available dates'} <Icon name="arrow-up-right" className="icon h-4 w-4" />
          </a>
          <a href={contactUrl} onClick={close} className="btn btn-outline w-full">Ask a question first</a>
          <p className="flex items-center justify-center gap-2 pt-1 text-xs text-ink-soft"><Icon name="shield" className="icon h-4 w-4" /> Secure booking and payment by Pixieset</p>
        </div>
      </div>
    </div>
  );
}
