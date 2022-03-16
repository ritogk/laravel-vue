<template>
  <div>
    <div class="card w-75 mx-auto">
      <div class="card-header bg-primary text-white">ログイン</div>
      <div class="card-body">
        <!-- 入力(メールアドレス) -->
        <div class="mb-3">
          <label for="inputMailAddress" class="form-label"
            >メールアドレス</label
          >
          <input
            type="email"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.email !== '' ? 'is-invalid' : '']"
            id="inputMailAddress"
            aria-describedby="inputMailAddressFeedback"
            v-model="form.email"
            placeholder="test@test.co.jp"
          />
          <div
            id="inputMailAddressFeedback"
            class="invalid-feedback"
            v-text="formErrors.email"
            v-show="formErrors.email !== ''"
          />
        </div>
        <!-- 入力(パスワード)) -->
        <div class="mb-3">
          <label for="inputPassword" class="form-label fs-6">パスワード</label>
          <input
            type="password"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.password !== '' ? 'is-invalid' : '']"
            id="inputPassword"
            aria-describedby="inputPasswordFeedback"
            v-model="form.password"
            placeholder="test"
          />
          <div
            id="inputPasswordFeedback"
            class="invalid-feedback"
            v-text="formErrors.password"
            v-show="formErrors.password !== ''"
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
import { defineComponent, reactive, inject } from 'vue';
import { useRouter } from 'vue-router';
import { validaitonErrorsType } from '@/libs/type';
import {
  userAuthenticationKey,
  useUserAuthenticationType,
} from '@/composables/useUserAuthentication';

export default defineComponent({
  setup() {
    const router = useRouter();
    const { login, getMe } = inject(
      userAuthenticationKey
    ) as useUserAuthenticationType;

    // フォームの状態
    const form = reactive({ email: 'root@rito.co.jp', password: 'root' });
    // フォームのエラー内容
    const formErrors = reactive({ email: '', password: '' });

    // 「ログイン」ボタン押下
    const clickLogin = async () => {
      // ログイン
      const response = await login(form.email, form.password);
      // ログイン済のユーザー情報を取得
      getMe();
      // 正常の場合
      if (!response) {
        router.push('/');
        return;
      }
      // バリデーションで弾かれた場合の場合
      formErrors.email = '';
      formErrors.password = '';
      const errors = (response as validaitonErrorsType).errors;
      if ('email' in errors) {
        formErrors.email = errors['email'][0];
      }
      if ('password' in errors) {
        formErrors.password = errors['password'][0];
      }
    };

    return { form, formErrors, clickLogin };
  },
});
</script>
