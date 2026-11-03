import { useEffect, useRef, useState } from 'react';
import { Icon } from '../lib/ui.jsx';

/** Swipeable on phones, a calm three-up grid from tablet up. No autoplay. */
export default function Testimonials({ reviews }) {
  const track = useRef(null);
  const [active, setActive] = useState(0);

  useEffect(() => {
    const el = track.current;
    if (!el) return;
    const io = new IntersectionObserver((entries) => entries.forEach((e) => e.isIntersecting && setActive(Number(e.target.dataset.i))), { root: el, threshold: 0.6 });
    [...el.children].forEach((c) => io.observe(c));
    return () => io.disconnect();
  }, []);

  const goTo = (i) => track.current?.children[i]?.scrollIntoView({ behavior: 'smooth', inline: 'start', block: 'nearest' });

  return (
    <div className="mt-14">
      <ul ref={track} className="-mx-4 flex snap-x snap-mandatory gap-4 overflow-x-auto px-4 pb-2 no-scrollbar md:mx-0 md:grid md:grid-cols-3 md:gap-6 md:overflow-visible md:px-0" aria-label="Client reviews">
        {reviews.map((r, i) => (
          <li key={i} data-i={i} className="w-[85%] shrink-0 snap-start md:w-auto">
            <figure className="flex h-full flex-col rounded-[1.5rem] border border-line bg-ivory p-7 md:p-8">
              <div className="flex items-center justify-between gap-4">
                <span className="flex gap-1 text-taupe" aria-label="5 out of 5 stars">{[0, 1, 2, 3, 4].map((s) => <Icon key={s} name="star" className="icon icon-fill h-4 w-4" />)}</span>
                {r.sample && <span className="rounded-full bg-lavender-wash px-2.5 py-1 text-[.62rem] font-semibold uppercase tracking-[.18em] text-ink-soft">Sample</span>}
              </div>
              <blockquote className="mt-5 flex-1 font-display text-[1.45rem] leading-snug text-ink"><p>&ldquo;{r.quote}&rdquo;</p></blockquote>
              <figcaption className="mt-6 border-t border-line pt-5 text-sm"><span className="font-semibold">{r.name}</span> <span className="text-ink-soft">&middot; {r.session}</span></figcaption>
            </figure>
          </li>
        ))}
      </ul>
      <div className="mt-6 flex items-center justify-center gap-2 md:hidden">
        {reviews.map((_, i) => (
          <button key={i} type="button" onClick={() => goTo(i)} aria-label={`Show review ${i + 1}`} aria-current={active === i}
            className="flex h-11 w-8 items-center justify-center">
            <span className={`block h-1.5 rounded-full transition-all duration-300 ${active === i ? 'w-6 bg-taupe-deep' : 'w-1.5 bg-line'}`} />
          </button>
        ))}
      </div>
    </div>
  );
}
