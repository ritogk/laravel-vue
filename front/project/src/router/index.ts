import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import JobCategory from '@/views/JobCategory.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'JobCategory',
    component: JobCategory,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
