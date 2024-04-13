
import { createApp } from 'vue'
import App from './App.vue'
import Toast from "vue-toastification";
import "@/assets/css/custom-toast-style.scss";
// import "@/assets/css/auth-style.scss";
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
const app = createApp(App)
app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 10,
    newestOnTop: true,
    ...pluginOptions
  });
app.mount('#app')
