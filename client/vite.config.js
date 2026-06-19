import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [vue(), tailwindcss()],
  base: '/dist/',
  build: {
    outDir: '../server/public/dist',
    emptyOutDir: true,
  },
})
