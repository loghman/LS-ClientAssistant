
import { createApp } from 'vue';
import AuthPage from './views/AuthPage.vue';
import { createPinia } from 'pinia';
import '@/js/utilities/jquery'
import '@/js/utilities/toast'
import '@/js/utilities/form-inputs.js'

const app = createApp(AuthPage);
const pinia = createPinia();
app.use(pinia);
app.mount('#app');
