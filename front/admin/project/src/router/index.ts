import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import AdminLogin from '@/views/AdminLogin.vue';
import DashBoard from '@/views/DashBoard.vue';
import ConsiderationList from '@/views/DashBoard/ConsiderationList.vue';
import JobCategoryMasterList from '@/views/DashBoard/JobCategoryMasterList.vue';
import JobCategoryMasterEntry from '@/views/DashBoard/JobCategoryMasterEntry.vue';
import JobMasterList from '@/views/DashBoard/JobMasterList.vue';
import JobMasterEntry from '@/views/DashBoard/JobMasterEntry.vue';
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
      // 選考一覧
      {
        path: 'consideration-list',
        name: 'ConsiderationList',
        component: ConsiderationList,
      },
      // 職種マスタ(一覧)
      {
        path: 'job-category-master-list',
        name: 'JobCategoryMasterList',
        component: JobCategoryMasterList,
      },
      // 職種マスタ(新規登録)
      {
        path: 'job-category-master-create',
        name: 'JobCategoryMasterCreate',
        component: JobCategoryMasterEntry,
      },
      // 職種マスタ(更新)
      {
        path: 'job-category-master-edit/:id',
        name: 'JobCategoryMasterEdit',
        component: JobCategoryMasterEntry,
      },
      // 仕事マスタ(一覧)
      {
        path: 'job-master-list',
        name: 'JobMasterList',
        component: JobMasterList,
      },
      // 仕事マスタ(新規登録)
      {
        path: 'job-master-create',
        name: 'JobMasterCreate',
        component: JobMasterEntry,
      },
      // 仕事マスタ(更新)
      {
        path: 'job-master-edit/:id',
        name: 'JobMasterEdit',
        component: JobMasterEntry,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
