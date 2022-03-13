<template>
  <div>
    <div class="card w-75 mx-auto">
      <div class="card-header bg-primary text-white">ログイン</div>
      <div class="card-body">
        <!-- 入力(メールアドレス) -->
        <div class="mb-3">
          <label for="inputMailAddress" class="form-label fs-6"
            >メールアドレス</label
          >
          <input
            type="email"
            class="form-control form-control-sm"
            id="inputMailAddress"
            placeholder="test@test.co.jp"
            v-model="form.email"
          />
        </div>
        <!-- 入力(パスワード)) -->
        <div class="mb-3">
          <label for="inputPassword" class="form-label fs-6">パスワード</label>
          <input
            type="password"
            class="form-control form-control-sm"
            id="inputPassword"
            placeholder="test"
            v-model="form.password"
          />
        </div>
        <!-- 検索-->
        <div class="mt-3">
          <button
            type="button"
            class="btn btn-primary w-100 text-light"
            @click="clickLogin"
          >
            ログイン
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import { AuthFrontApi, AuthFrontLoginPostRequest } from '@/open_api';
import { apiConfig } from '@/libs/config';

export default defineComponent({
  setup() {
    const router = useRouter();
    // フォームの状態
    const form = reactive({ email: 'root@rito.co.jp', password: 'root' });

    // 「ログイン」ボタン押下
    const clickLogin = async () => {
      const authFrontApi = new AuthFrontApi(apiConfig);
      const request: AuthFrontLoginPostRequest = {
        requestLogin: { email: form.email, password: form.password },
      };
      await authFrontApi.authFrontLoginPost(request);
      router.push('/');
    };

    return { form, clickLogin };
  },
});
</script>
