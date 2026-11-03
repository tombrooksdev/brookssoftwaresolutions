import { useRef, useState } from 'react';
import { Icon } from '../lib/ui.jsx';

const field = 'w-full rounded-xl border bg-ivory px-4 py-3 text-ink transition-colors placeholder:text-ink-soft/70 focus:border-taupe-deep focus:outline-none focus:ring-2 focus:ring-taupe-deep/25';

export default function ContactForm({ action, token, sessionTypes, email, preview }) {
  const [values, setValues] = useState({ name: '', email: '', phone: '', session: sessionTypes[0], dates: '', message: '', consent: false, website: '' });
  const [errors, setErrors] = useState({});
  const [status, setStatus] = useState({ state: 'idle', message: '' });
  const started = useRef(Math.floor(Date.now() / 1000));

  const set = (k) => (e) => setValues((v) => ({ ...v, [k]: e.target.type === 'checkbox' ? e.target.checked : e.target.value }));

  const validate = () => {
    const e = {};
    if (!values.name.trim()) e.name = 'Please add your name.';
    if (!/^\S+@\S+\.\S+$/.test(values.email)) e.email = 'Please add a valid email address, like name@example.com.';
    if (values.message.trim().length < 5) e.message = 'Please tell me a little about what you are looking for.';
    if (!values.consent) e.consent = 'Please tick this so I can reply to you.';
    return e;
  };

  const submit = async (ev) => {
    ev.preventDefault();
    const e = validate();
    setErrors(e);
    if (Object.keys(e).length) {
      document.getElementById(`cf-${Object.keys(e)[0]}`)?.focus();
      return;
    }
    if (preview) {
      setStatus({ state: 'ok', message: `This is a preview, so nothing was sent. On the live site this message goes straight to ${email}.` });
      return;
    }
    setStatus({ state: 'sending', message: '' });
    const body = new FormData();
    Object.entries({ ...values, _token: token, started: started.current, message: values.message + (values.dates ? `\n\nPreferred dates: ${values.dates}` : '') + (values.phone ? `\nPhone: ${values.phone}` : '') })
      .forEach(([k, v]) => body.append(k, k === 'consent' ? (v ? '1' : '') : v));
    try {
      const res = await fetch(action, { method: 'POST', body, headers: { Accept: 'application/json' } });
      const data = await res.json();
      setStatus({ state: data.ok ? 'ok' : 'error', message: data.message });
    } catch {
      setStatus({ state: 'error', message: `Your message could not be sent. Please email me at ${email}.` });
    }
  };

  if (status.state === 'ok') {
    return (
      <div className="animate-[rise_.6s_cubic-bezier(.22,.61,.36,1)_both] rounded-2xl bg-sage-wash p-8 text-center" role="status">
        <span className="mx-auto inline-flex h-14 w-14 items-center justify-center rounded-full bg-ivory text-taupe-deep"><Icon name="heart" className="icon icon-lg" /></span>
        <h3 className="t-h3 mt-4">Thank you</h3>
        <p className="mx-auto mt-2 max-w-sm text-sm leading-relaxed text-ink-soft">{status.message}</p>
      </div>
    );
  }

  const err = (k) => errors[k] && <p id={`cf-${k}-error`} className="mt-2 flex items-center gap-1.5 text-sm text-[rgb(var(--danger))]"><Icon name="info" className="icon h-4 w-4" />{errors[k]}</p>;
  const aria = (k) => ({ 'aria-invalid': !!errors[k], 'aria-describedby': errors[k] ? `cf-${k}-error` : undefined });
  const border = (k) => (errors[k] ? 'border-[rgb(var(--danger))]' : 'border-line');

  return (
    <form onSubmit={submit} noValidate className="grid gap-5">
      <div className="hidden" aria-hidden="true"><label htmlFor="cf-website">Leave this empty</label><input id="cf-website" tabIndex={-1} autoComplete="off" value={values.website} onChange={set('website')} /></div>
      <div className="grid gap-5 sm:grid-cols-2">
        <div><label htmlFor="cf-name" className="mb-2 block text-sm font-medium">Your name</label><input id="cf-name" autoComplete="name" className={`${field} ${border('name')}`} value={values.name} onChange={set('name')} {...aria('name')} />{err('name')}</div>
        <div><label htmlFor="cf-email" className="mb-2 block text-sm font-medium">Email</label><input id="cf-email" type="email" inputMode="email" autoComplete="email" className={`${field} ${border('email')}`} value={values.email} onChange={set('email')} {...aria('email')} />{err('email')}</div>
      </div>
      <div className="grid gap-5 sm:grid-cols-2">
        <div><label htmlFor="cf-phone" className="mb-2 block text-sm font-medium">Phone <span className="font-normal text-ink-soft">(optional)</span></label><input id="cf-phone" type="tel" inputMode="tel" autoComplete="tel" className={`${field} border-line`} value={values.phone} onChange={set('phone')} /></div>
        <div>
          <label htmlFor="cf-session" className="mb-2 block text-sm font-medium">Session type</label>
          <div className="relative">
            <select id="cf-session" className={`${field} appearance-none border-line pr-10`} value={values.session} onChange={set('session')}>{sessionTypes.map((s) => <option key={s}>{s}</option>)}</select>
            <Icon name="chevron-down" className="icon pointer-events-none absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-soft" />
          </div>
        </div>
      </div>
      <div><label htmlFor="cf-dates" className="mb-2 block text-sm font-medium">Preferred dates <span className="font-normal text-ink-soft">(optional)</span></label><input id="cf-dates" placeholder="e.g. weekends in May" className={`${field} border-line`} value={values.dates} onChange={set('dates')} /></div>
      <div><label htmlFor="cf-message" className="mb-2 block text-sm font-medium">Message</label><textarea id="cf-message" rows={5} placeholder="Who will be in the photos, and anything you have in mind" className={`${field} ${border('message')}`} value={values.message} onChange={set('message')} {...aria('message')} />{err('message')}</div>
      <div>
        <div className="flex gap-3 text-sm text-ink-soft">
          <input id="cf-consent" type="checkbox" className="mt-1 h-4 w-4 shrink-0 accent-[rgb(117_101_92)]" checked={values.consent} onChange={set('consent')} {...aria('consent')} />
          <label htmlFor="cf-consent">I'm happy for Brooks &amp; Bloom to use these details to reply to me, as set out in the privacy policy.</label>
        </div>
        {err('consent')}
      </div>
      {status.state === 'error' && <p role="alert" className="rounded-xl bg-lavender-wash p-4 text-sm">{status.message}</p>}
      <div><button type="submit" disabled={status.state === 'sending'} className="btn btn-primary w-full disabled:opacity-60 sm:w-auto">
        <Icon name="send" /> {status.state === 'sending' ? 'Sending' : 'Send message'}
      </button></div>
    </form>
  );
}
