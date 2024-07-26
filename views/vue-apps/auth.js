
import { createApp } from 'vue';
import AuthPage from './views/AuthPage.vue';
import { createPinia } from 'pinia';
import './assets/js/utilities/jquery'
import './assets/js/utilities/toast'
import './assets/js/utilities/form-inputs.js'

const app = createApp(AuthPage);
const pinia = createPinia();
app.use(pinia);
app.mount('#app');
