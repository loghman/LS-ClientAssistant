import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import dotenv from "dotenv";
import path from "path";
// Specify the path to your .env file
const envPath = path.resolve(__dirname, '../../../.env');
// Load environment variables from .env file and put them in proccess.env
dotenv.config({ path: envPath });
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue()
  ],
  build: {
    // generate .vite/manifest.json in outDir
    manifest: true,
    outDir: "../../../public/dist",
    emptyOutDir: true, // Clear the output directory before building
    rollupOptions: {
      input: {
        auth: path.resolve(
          __dirname,
          "./views/vue-apps/auth.js"
        ),
        onboarding: path.resolve(
          __dirname,
          "./views/vue-apps/onboarding.js"
        ),
      },
    },
    // Disable generating HTML files
    html: false,
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./views/vue-apps', import.meta.url))
    }
  },
  define: {
    "import.meta.env.APP_URL": process.env.APP_URL ? JSON.stringify(
        process.env.APP_URL
    ):null,
    "import.meta.env.API_BASE_URL": process.env.API_BASE_URL ? JSON.stringify(
        process.env.API_BASE_URL
    ):null,
    "import.meta.env.CLIENT_URL": process.env.CLIENT_URL ? JSON.stringify(
        process.env.CLIENT_URL
    ):null,
},
  // server: {
  //   // Change the host to your desired URL
  //   host: 'test.lsp.test',
  //   port: 5174, // You can also change the port if needed
  // },
})
