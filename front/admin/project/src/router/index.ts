import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import AdminLogin from '@/views/AdminLogin.vue';
import DashBoard from '@/views/DashBoard.vue';
import JobCategoryMasterList from '@/views/DashBoard/JobCategoryMasterList.vue';
import JobCategoryMasterEntry from '@/views/DashBoard/JobCategoryMasterEntry.vue';

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
      {
        path: 'job-category-master-create',
        name: 'JobCategoryMasterCreate',
        component: JobCategoryMasterEntry,
      },
      {
        path: 'job-category-master-edit/:id',
        name: 'JobCategoryMasterEdit',
        component: JobCategoryMasterEntry,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
