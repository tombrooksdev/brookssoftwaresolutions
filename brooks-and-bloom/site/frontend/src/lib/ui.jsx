import { useEffect, useRef, useState } from 'react';

export const Icon = ({ name, className = 'icon' }) => (
  <svg className={className} aria-hidden="true" focusable="false"><use href={`#i-${name}`} /></svg>
);

export function Photo({ item, className = '', eager = false }) {
  if (item.url) {
    return <img className={`photo ${className}`} src={item.url} alt={item.alt} style={{ aspectRatio: item.ratio }} loading={eager ? 'eager' : 'lazy'} decoding="async" />;
  }
  return (
    <div className={`photo placeholder tone-${item.tone} ${className}`} style={{ aspectRatio: item.ratio }} role="img" aria-label={item.alt}>
      <Icon name="flower" className="placeholder-mark" />
      {item.label && <span className="placeholder-label">{item.label}</span>}
    </div>
  );
}

const FOCUSABLE = 'a[href],button:not([disabled]),input,select,textarea,[tabindex]:not([tabindex="-1"])';

/** Escape to close, Tab stays inside, focus returns to the opener, page behind doesn't scroll. */
export function useDialog(open, onClose) {
  const ref = useRef(null);
  useEffect(() => {
    if (!open) return;
    const opener = document.activeElement;
    const root = document.documentElement;
    const prevOverflow = root.style.overflow;
    root.style.overflow = 'hidden';
    const t = setTimeout(() => ref.current?.querySelector('[data-autofocus]')?.focus() ?? ref.current?.querySelector(FOCUSABLE)?.focus(), 60);
    const onKey = (e) => {
      if (e.key === 'Escape') { e.preventDefault(); onClose(); }
      if (e.key !== 'Tab' || !ref.current) return;
      const els = [...ref.current.querySelectorAll(FOCUSABLE)].filter((el) => el.offsetParent !== null);
      if (!els.length) return;
      const first = els[0], last = els[els.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    };
    document.addEventListener('keydown', onKey);
    return () => {
      clearTimeout(t);
      document.removeEventListener('keydown', onKey);
      root.style.overflow = prevOverflow;
      opener?.focus?.({ preventScroll: true });
    };
  }, [open, onClose]);
  return ref;
}

/** Keep a component mounted for its exit animation. */
export function usePresence(open, ms = 400) {
  const [state, setState] = useState(open ? 'open' : 'closed');
  useEffect(() => {
    if (open) { setState('mounted'); const r = requestAnimationFrame(() => requestAnimationFrame(() => setState('open'))); return () => cancelAnimationFrame(r); }
    if (state === 'closed') return;
    setState('closing');
    const t = setTimeout(() => setState('closed'), ms);
    return () => clearTimeout(t);
  }, [open]); // eslint-disable-line react-hooks/exhaustive-deps
  return { mounted: state !== 'closed', visible: state === 'open' };
}
