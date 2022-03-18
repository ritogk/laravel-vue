import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import AdminLogin from '@/views/AdminLogin.vue';
import DashBoard from '@/views/DashBoard.vue';
import JobCategoryMasterList from '@/components/dashboard/JobCategoryMasterList.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'AdminLogin',
    component: AdminLogin,
  },
  {
    path: '/dashboard',
    name: 'DashBoard',
    component: DashBoard,
    children: [
      {
        path: 'job-category-master-list',
        name: 'JobCategoryMasterList',
        component: JobCategoryMasterList,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
