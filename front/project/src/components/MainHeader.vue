<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" @click="clickTitle">求人検索</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-end" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a
              class="nav-link active"
              aria-current="page"
              href="#"
              @click="clickLogout"
              >ログアウト</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" v-text="user.name"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click="clickLogin">ログイン</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click="clickRegistration">新規登録</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">管理画面</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script lang="ts">
import { defineComponent, inject } from 'vue';
import { useRouter } from 'vue-router';
import {
  userAuthenticationKey,
  useUserAuthenticationType,
} from '@/composables/useUserAuthentication';

export default defineComponent({
  setup() {
    const router = useRouter();
    const { userAuthenticationRefs, logout } = inject(
      userAuthenticationKey
    ) as useUserAuthenticationType;

    // 「タイトル」押下
    const clickTitle = () => {
      router.push('/');
    };
    // 「新規登録」押下
    const clickRegistration = () => {
      router.push({ name: 'UserRegistration' });
    };
    // 「ログアウト」押下
    const clickLogout = () => {
      logout();
    };
    // 「ログイン」押下
    const clickLogin = () => {
      router.push({ name: 'UserLogin' });
    };
    return {
      user: userAuthenticationRefs.user,
      clickTitle,
      clickRegistration,
      clickLogin,
      clickLogout,
    };
  },
});
</script>
