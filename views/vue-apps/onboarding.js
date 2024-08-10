
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import '@/js/utilities/jquery'
import '@/js/utilities/toast'
import '@/js/utilities/form-inputs.js'
import OnboardingPage from './views/OnboardingPage.vue';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'

const app = createApp(OnboardingPage);
const pinia = createPinia();
app.use(pinia);
app.use(PrimeVue, {
  theme: {
      preset: Aura
  }
});
app.use(Vue3PersianDatetimePicker, {
  name: 'DatePicker',
  props: {
   color: "var(--primary)",
   border: 'none',
  }
});
app.mount('#app');
