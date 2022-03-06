import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import AboutView from '@/views/AboutView.vue';
import TestView from '@/views/TestView.vue';
import HomeView from '@/views/HomeView.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/about',
    name: 'About',
    component: AboutView,
  },
  {
    path: '/test',
    name: 'Test',
    component: TestView,
  },
  { path: '/*', component: HomeView },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
