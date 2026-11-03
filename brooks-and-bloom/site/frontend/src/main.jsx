import './styles.css';
import { createRoot } from 'react-dom/client';
import MobileNav from './islands/MobileNav.jsx';
import BookingDrawer from './islands/BookingDrawer.jsx';
import PortfolioGallery from './islands/PortfolioGallery.jsx';
import ContactForm from './islands/ContactForm.jsx';
import Testimonials from './islands/Testimonials.jsx';
import { initDrawPaths, initHeader, initPreviewViews, initReveal, initToTop } from './lib/motion.js';

const islands = { MobileNav, BookingDrawer, PortfolioGallery, ContactForm, Testimonials };

function mountIslands() {
  document.querySelectorAll('[data-island]').forEach((el) => {
    const Component = islands[el.dataset.island];
    if (!Component) return;
    let props = {};
    try { props = JSON.parse(el.dataset.props || '{}'); } catch { /* keep server fallback */ return; }
    createRoot(el).render(<Component {...props} />);
  });
}

function boot() {
  mountIslands();
  initPreviewViews();
  initHeader();
  initDrawPaths();
  initToTop();
  requestAnimationFrame(() => initReveal());
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
else boot();
