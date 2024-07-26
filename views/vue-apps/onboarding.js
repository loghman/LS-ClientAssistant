
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import './assets/js/utilities/jquery'
import './assets/js/utilities/toast';
import './assets/js/utilities/form-inputs.js'
import OnboardingPage from './views/OnboardingPage.vue';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';

const app = createApp(OnboardingPage);
const pinia = createPinia();
app.use(pinia);
app.use(PrimeVue, {
  theme: {
      preset: Aura
  }
});
app.mount('#app');
