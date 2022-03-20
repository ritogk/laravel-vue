<template>
  <router-view />
</template>

<script lang="ts">
import { defineComponent, provide } from 'vue';
import {
  useAdminAuthentication,
  adminAuthenticationKey,
} from '@/composables/useAdminAuthentication';

export default defineComponent({
  setup() {
    const adminAuthentication = useAdminAuthentication();
    provide(adminAuthenticationKey, adminAuthentication);

    // ログイン済のユーザー情報を取得
    adminAuthentication.getMe();

    return {};
  },
});
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
