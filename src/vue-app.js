import '@/assets/css/main.css'

import {createApp, defineAsyncComponent} from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import Toast from "vue-toastification";
import "@/assets/css/custom-toast-style.scss";
const pluginOptions = {
  position: "top-center",
  timeout: 7000,
  closeOnClick: false,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.78,
  showCloseButtonOnHover: false,
  hideProgressBar: true,
  closeButton: "button",
  icon: true,
  rtl: true
};
const app = createApp(App,{
  'v-auth-page': defineAsyncComponent(() => import('./views/AuthPage.vue')),
})

app.use(createPinia())
app.use(router)
app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 10,
    newestOnTop: true,
    ...pluginOptions
  });
app.mount('#app')
