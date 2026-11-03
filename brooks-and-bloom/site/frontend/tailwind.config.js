const tone = (v) => `rgb(var(--${v}) / <alpha-value>)`;

/** @type {import('tailwindcss').Config} */
export default {
  content: ['../app/**/*.php', './src/**/*.{js,jsx}'],
  theme: {
    extend: {
      colors: {
        ivory: tone('ivory'),
        surface: tone('surface'),
        ink: { DEFAULT: tone('ink'), soft: tone('ink-soft') },
        taupe: { DEFAULT: tone('taupe'), deep: tone('taupe-deep') },
        lavender: { DEFAULT: tone('lavender'), wash: tone('lavender-wash') },
        sage: { DEFAULT: tone('sage'), wash: tone('sage-wash') },
        line: tone('line'),
        'on-accent': tone('on-accent'),
      },
      fontFamily: {
        display: ['"Cormorant Garamond"', '"Cormorant"', 'Garamond', '"Times New Roman"', 'serif'],
        sans: ['Montserrat', '"Helvetica Neue"', 'Arial', 'system-ui', 'sans-serif'],
      },
      maxWidth: { prose: '65ch' },
      transitionTimingFunction: { soft: 'cubic-bezier(.22,.61,.36,1)' },
    },
  },
  plugins: [],
};
