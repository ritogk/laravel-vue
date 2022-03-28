<style scoped>
body {
  font-size: 0.875rem;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
}

.header-bar {
  background: #212529 !important;
}
</style>

<template>
  <div>
    <!-- ヘッダー -->
    <Header />
    <div class="container-fluid">
      <div class="row">
        <!-- サイドバー -->
        <Sidebar />
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3"
          >
            <!-- 画面の表示エリア-->
            <transition name="fade">
              <router-view />
            </transition>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, inject, ref } from 'vue';
import { useRouter } from 'vue-router';
import Header from '@/components/dashborad/Header.vue';
import Sidebar from '@/components/dashborad/Sidebar.vue';
import {
  useAdminAuthenticationType,
  adminAuthenticationKey,
} from '@/composables/useAdminAuthentication';

export default defineComponent({
  components: {
    Header,
    Sidebar,
  },
  setup() {
    const router = useRouter();

    const { adminAuthenticationRefs, logout } = inject(
      adminAuthenticationKey
    ) as useAdminAuthenticationType;
    const user = adminAuthenticationRefs.user;

    // アクティブなメニューNo
    const activeMenuNo = ref(0);
    // 指定のメニューNoがアクティブかどうかを判定します。
    const isActiveMenuNo = (index: number): boolean => {
      return activeMenuNo.value === index;
    };
    // アクティブなメニューNoを設定します。
    const setActiveMenuNo = (index: number) => {
      activeMenuNo.value = index;
    };

    // 「ログアウト」押下時の処理
    const clickLogout = () => {
      logout();
      router.push({ name: 'AdminLogin' });
    };

    // 「選考一覧」押下時の処理
    const clickConsideration = () => {
      router.push({ name: 'ConsiderationList' });
    };

    // 「職種マスタ」押下時の処理
    const clickJobCategory = () => {
      router.push({ name: 'JobCategoryMasterList' });
    };

    // 「仕事マスタ」押下時の処理
    const clickJob = () => {
      router.push({ name: 'JobMasterList' });
    };

    return {
      user,
      clickConsideration,
      clickJobCategory,
      clickLogout,
      clickJob,
      isActiveMenuNo,
      setActiveMenuNo,
    };
  },
});
</script>
