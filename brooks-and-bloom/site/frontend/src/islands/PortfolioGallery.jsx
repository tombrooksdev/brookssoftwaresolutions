import { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import { createPortal } from 'react-dom';
import { Icon, Photo, useDialog, usePresence } from '../lib/ui.jsx';

export default function PortfolioGallery({ items, categories }) {
  const [filter, setFilter] = useState('all');
  const [index, setIndex] = useState(null);
  const [fadeKey, setFadeKey] = useState(0);
  const shown = useMemo(() => (filter === 'all' ? items : items.filter((i) => i.cat === filter)), [items, filter]);

  const choose = (key) => { setFilter(key); setFadeKey((k) => k + 1); };
  const counts = useMemo(() => items.reduce((acc, i) => ({ ...acc, [i.cat]: (acc[i.cat] || 0) + 1 }), {}), [items]);

  return (
    <>
      <div className="-mx-4 mb-10 overflow-x-auto px-4 no-scrollbar sm:mx-0 sm:px-0" role="group" aria-label="Filter photos">
        <div className="flex w-max gap-2">
          <button type="button" className="chip" aria-pressed={filter === 'all'} onClick={() => choose('all')}>All <span className="opacity-60">{items.length}</span></button>
          {Object.entries(categories).map(([key, label]) => (
            <button key={key} type="button" className="chip" aria-pressed={filter === key} onClick={() => choose(key)}>{label} <span className="opacity-60">{counts[key] || 0}</span></button>
          ))}
        </div>
      </div>
      <p className="sr-only" aria-live="polite">Showing {shown.length} photos</p>
      <ul key={fadeKey} className="masonry">
        {shown.map((item, i) => (
          <li key={`${item.cat}-${i}`} className="animate-[rise_.7s_cubic-bezier(.22,.61,.36,1)_both]" style={{ animationDelay: `${Math.min(i, 8) * 45}ms` }}>
            <button type="button" onClick={() => setIndex(i)} className="zoom-wrap group relative block w-full overflow-hidden rounded-2xl text-left">
              <Photo item={item} />
              <span className="absolute inset-0 flex items-end justify-end bg-gradient-to-t from-ink/25 to-transparent p-3 opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-focus-visible:opacity-100">
                <span className="inline-flex h-10 w-10 items-center justify-center rounded-full bg-ivory/90 text-ink"><Icon name="plus" className="icon h-5 w-5" /></span>
              </span>
              <span className="sr-only">Open photo: {item.alt}</span>
            </button>
          </li>
        ))}
      </ul>
      <Lightbox items={shown} index={index} setIndex={setIndex} />
    </>
  );
}

function Lightbox({ items, index, setIndex }) {
  const open = index !== null;
  const close = useCallback(() => setIndex(null), [setIndex]);
  const ref = useDialog(open, close);
  const { mounted, visible } = usePresence(open, 350);
  const last = useRef(0);
  if (open) last.current = index;
  const i = open ? index : last.current;
  const item = items[i];
  const go = useCallback((d) => setIndex((cur) => (cur === null ? cur : (cur + d + items.length) % items.length)), [items.length, setIndex]);
  const touch = useRef(null);

  useEffect(() => {
    if (!open) return;
    const onKey = (e) => { if (e.key === 'ArrowRight') go(1); if (e.key === 'ArrowLeft') go(-1); };
    document.addEventListener('keydown', onKey);
    return () => document.removeEventListener('keydown', onKey);
  }, [open, go]);

  if (!mounted || !item) return null;
  return createPortal(
    <div ref={ref} role="dialog" aria-modal="true" aria-label="Photo viewer"
      className={`fixed inset-0 z-[80] flex flex-col bg-[rgb(28_24_22/.96)] text-[rgb(250_249_247)] transition-opacity duration-300 ${visible ? 'opacity-100' : 'opacity-0'}`}
      style={{ padding: 'env(safe-area-inset-top,0px) env(safe-area-inset-right,0px) env(safe-area-inset-bottom,0px) env(safe-area-inset-left,0px)' }}
      onTouchStart={(e) => { touch.current = e.touches[0].clientX; }}
      onTouchEnd={(e) => { if (touch.current === null) return; const dx = e.changedTouches[0].clientX - touch.current; if (Math.abs(dx) > 50) go(dx < 0 ? 1 : -1); touch.current = null; }}>
      <div className="flex items-center justify-between px-4 py-3 text-sm sm:px-6">
        <span className="tabular-nums opacity-80">{i + 1} / {items.length}</span>
        <button type="button" onClick={close} data-autofocus className="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/20 hover:bg-white/10">
          <Icon name="close" /><span className="sr-only">Close viewer</span>
        </button>
      </div>
      <div className="relative flex min-h-0 flex-1 items-center justify-center px-4 sm:px-20">
        <figure key={i} className="flex max-h-full w-full max-w-3xl animate-[settle_.5s_cubic-bezier(.22,.61,.36,1)_both] flex-col items-center">
          <div className="max-h-[72dvh] w-full overflow-hidden rounded-xl [&>*]:mx-auto [&>*]:max-h-[72dvh] [&>*]:w-auto [&>.placeholder]:h-[60dvh]"><Photo item={item} eager /></div>
          <figcaption className="mt-4 text-center text-sm opacity-80">{item.alt}</figcaption>
        </figure>
        <button type="button" onClick={() => go(-1)} className="absolute left-2 top-1/2 hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 hover:bg-white/10 sm:inline-flex sm:left-6"><Icon name="chevron-left" /><span className="sr-only">Previous photo</span></button>
        <button type="button" onClick={() => go(1)} className="absolute right-2 top-1/2 hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 hover:bg-white/10 sm:inline-flex sm:right-6"><Icon name="chevron-right" /><span className="sr-only">Next photo</span></button>
      </div>
      <div className="flex justify-center gap-3 py-4 sm:hidden">
        <button type="button" onClick={() => go(-1)} className="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/20"><Icon name="chevron-left" /><span className="sr-only">Previous photo</span></button>
        <button type="button" onClick={() => go(1)} className="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/20"><Icon name="chevron-right" /><span className="sr-only">Next photo</span></button>
      </div>
    </div>,
    document.body,
  );
}
