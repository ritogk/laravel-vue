<style scoped>
.navbar-brand {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, 0.25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.25);
}

.navbar .navbar-toggler {
  top: 0.25rem;
  right: 1rem;
}

.navbar .form-control {
  padding: 0.75rem 1rem;
  border-width: 0;
  border-radius: 0;
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
  <header
    class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
  >
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">管理画面</a>
    <button
      class="navbar-toggler position-absolute d-md-none collapsed"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu"
      aria-controls="sidebarMenu"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <input
      class="form-control form-control-dark w-100 header-bar"
      type="text"
      placeholder=""
      aria-label=""
      disabled
    />
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#" @click="clickLogout">ログアウト</a>
      </li>
    </ul>
  </header>
</template>

<script lang="ts">
import { defineComponent, inject } from 'vue';
import { useRouter } from 'vue-router';
import {
  useAdminAuthenticationType,
  adminAuthenticationKey,
} from '@/composables/useAdminAuthentication';

export default defineComponent({
  setup() {
    const router = useRouter();

    const { adminAuthenticationRefs, logout } = inject(
      adminAuthenticationKey
    ) as useAdminAuthenticationType;
    const user = adminAuthenticationRefs.user;

    // 「ログアウト」押下時の処理
    const clickLogout = () => {
      logout();
      router.push({ name: 'AdminLogin' });
    };

    return {
      user,
      clickLogout,
    };
  },
});
</script>
