import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

// Builds one IIFE bundle + one stylesheet into httpdocs/assets/build. Fixed names;
// PHP appends ?v=filemtime for cache busting, so no manifest is needed.
export default defineConfig({
  plugins: [react()],
  define: { 'process.env.NODE_ENV': JSON.stringify('production') },
  build: {
    outDir: '../httpdocs/assets/build',
    emptyOutDir: true,
    cssCodeSplit: false,
    rollupOptions: {
      input: 'src/main.jsx',
      output: { format: 'iife', entryFileNames: 'app.js', assetFileNames: 'app[extname]', inlineDynamicImports: true },
    },
  },
});
