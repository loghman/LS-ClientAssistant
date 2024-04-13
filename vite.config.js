import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue()
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./views/src', import.meta.url))
    }
  },
  server: {
    // Change the host to your desired URL
    host: 'test.lsp.test',
    port: 5174, // You can also change the port if needed
  },
})
