<template>
  <MainHeader />
  <div class="container py-4">
    <transition name="fade">
      <router-view />
    </transition>
  </div>
  <MainFooter />
</template>

<script lang="ts">
import { defineComponent, provide } from 'vue';
import MainHeader from '@/components/MainHeader.vue';
import MainFooter from '@/components/MainFooter.vue';
import {
  useUserAuthentication,
  userAuthenticationKey,
} from '@/composables/useUserAuthentication';

export default defineComponent({
  components: {
    MainHeader,
    MainFooter,
  },
  setup() {
    const userAuthentication = useUserAuthentication();
    provide(userAuthenticationKey, userAuthentication);

    // ログイン済のユーザー情報を取得
    userAuthentication.getMe();

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
</style>
