import { fileURLToPath, URL } from "node:url";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import dotenv from "dotenv";
import path from "path";
import ckeditor5 from "@ckeditor/vite-plugin-ckeditor5";
// Specify the path to your .env file
const envPath = path.resolve(__dirname, "../../../.env");
// Load environment variables from .env file and put them in proccess.env
dotenv.config({ path: envPath });
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    ckeditor5({
      theme: path.resolve("@ckeditor/ckeditor5-theme-lark"),
    }),
    vue(),
  ],
  build: {
    // generate .vite/manifest.json in outDir
    manifest: true,
    outDir: "../../../public/dist",
    emptyOutDir: true, // Clear the output directory before building
    rollupOptions: {
      input: {
        auth: path.resolve(__dirname, "./views/vue-apps/auth.js"),
        onboarding: path.resolve(__dirname, "./views/vue-apps/onboarding.js"),
        ckeditor: path.resolve(
          __dirname,
          "./resources/js/ckeditor/ckeditor.js"
        ),
        ck_style: path.resolve(
          __dirname,
          "./resources/js/ckeditor/ckeditor.css"
        ),
        content_styles: path.resolve(
          __dirname,
          "./resources/js/ckeditor/content-styles.css"
        ),
        video_drm_text: path.resolve(
          __dirname,
          "./resources/js/utilities/video-drm-text.js"
        ),
        uploader: path.resolve(
          __dirname,
          "./resources/js/utilities/uploader.js"
        ),
        auth_style: path.resolve(
          __dirname,
          "./views/vue-apps/assets/css/auth.scss"
        ),
        jquery: path.resolve(
          __dirname,
          "./resources/js/utilities/jquery.js"
        ),
      },
    },
    // Disable generating HTML files
    html: false,
  },
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./resources", import.meta.url)),
    },
  },
  define: {
    "import.meta.env.APP_URL": process.env.APP_URL
      ? JSON.stringify(process.env.APP_URL)
      : null,
    "import.meta.env.API_BASE_URL": process.env.CORE_URL
      ? JSON.stringify(process.env.CORE_URL)
      : null,
    "import.meta.env.CLIENT_URL": process.env.CLIENT_URL
      ? JSON.stringify(process.env.CLIENT_URL)
      : null,
    "import.meta.env.SHOW_IFRAME": process.env.SHOW_IFRAME
      ? JSON.stringify(process.env.SHOW_IFRAME)
      : null,
  },
  // server: {
  //   // Change the host to your desired URL
  //   host: 'test.lsp.test',
  //   port: 5174, // You can also change the port if needed
  // },
});
