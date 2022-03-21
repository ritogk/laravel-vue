<template>
  <transition name="fade">
    <router-view />
  </transition>
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

/* routerが切り替わったタイミングでフェードさせる*/
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.9s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/** テキストの一部をカットして表示する。 */
.cut-text {
  display: block;
  width: 400px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
</style>
