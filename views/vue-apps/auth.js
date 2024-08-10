
import { createApp } from 'vue';
import AuthPage from './views/AuthPage.vue';
import { createPinia } from 'pinia';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import '@/js/utilities/jquery'
import '@/js/utilities/toast'
import '@/js/utilities/form-inputs.js'

const app = createApp(AuthPage);
const pinia = createPinia();
app.use(pinia);
app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
  });
app.mount('#app');
