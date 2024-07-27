// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import AuthPage from '../views/AuthPage.vue'; 
import OnboardingPage from '../views/OnboardingPage.vue'; 

const routes = [
  { path: '/', component: AuthPage },
  { path: '/onboarding', component: OnboardingPage }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
