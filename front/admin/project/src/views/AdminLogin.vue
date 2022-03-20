<template>
  <div class="container py-4">
    <div class="card w-75 mx-auto border-primary">
      <div class="card-header bg-primary text-white">ログイン</div>
      <div class="card-body">
        <!-- 汎用エラーメッセージ -->
        <div class="mb-3">
          <div
            class="text-danger"
            v-text="formErrors.general"
            v-show="formErrors.general !== ''"
          />
        </div>
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
            v-model="formInputs.email"
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
            v-model="formInputs.password"
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
import {
  adminAuthenticationKey,
  useAdminAuthenticationType,
} from '@/composables/useAdminAuthentication';
import { isValidaitonErrorsType } from '@/libs/validation';

export default defineComponent({
  setup() {
    const router = useRouter();
    const { login, getMe } = inject(
      adminAuthenticationKey
    ) as useAdminAuthenticationType;

    // フォームの状態
    const formRefs = reactive({
      // 入力値
      inputs: {
        email: 'test@test.co.jp',
        password: 'test',
      },
      // エラーメッセージ
      errors: {
        email: '',
        password: '',
        general: '',
      },
    });

    // 「ログイン」ボタン押下の処理
    const clickLogin = async () => {
      // ログイン
      const response = await login(
        formRefs.inputs.email,
        formRefs.inputs.password
      );

      // 正常の場合
      if (!isValidaitonErrorsType(response)) {
        // ログイン済のユーザー情報を取得
        await getMe();
        // 「ダッシュボード」画面へ繊維
        router.push({ name: 'DashBoard' });
        return;
      }

      // ■以降の処理はバリデーションで弾かれた場合
      // エラーメッセージの初期化を行う。
      Object.keys(formRefs.errors).forEach(function (key) {
        formRefs.errors[key as keyof typeof formRefs.errors] = '';
      });
      // サーバーサイドから受け取ったエラーメッセージをセット。
      const errors = response.errors;
      Object.keys(errors).forEach(function (key) {
        formRefs.errors[key as keyof typeof formRefs.errors] = errors[key][0];
      });
      // 汎用エラーメッセージをセット。
      if (Object.keys(errors).indexOf('message') !== -1) {
        formRefs.errors.general = errors['message'][0];
      }
    };

    return {
      formInputs: formRefs.inputs,
      formErrors: formRefs.errors,
      clickLogin,
    };
  },
});
</script>
