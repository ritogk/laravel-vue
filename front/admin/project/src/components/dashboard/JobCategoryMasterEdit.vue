<template>
  <div class="w-100">
    <h1 class="h2 mb-3">職種マスタ(編集)</h1>
    <div class="card w-100 mx-auto">
      <div class="card-header">ログイン</div>
      <div class="card-body">
        <!-- 入力(名称) -->
        <div class="mb-3">
          <label for="inputMailAddress" class="form-label">名称</label>
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
        <!-- 入力(内容) -->
        <div class="mb-3">
          <label for="inputPassword" class="form-label">内容</label>
          <textarea
            class="form-control form-control-sm"
            v-bind:class="[formErrors.password !== '' ? 'is-invalid' : '']"
            id="inputPassword"
            aria-describedby="inputPasswordFeedback"
            v-model="form.password"
            placeholder="test"
            rows="5"
          />
          <div
            id="inputPasswordFeedback"
            class="invalid-feedback"
            v-text="formErrors.password"
            v-show="formErrors.password !== ''"
          />
        </div>
        <!-- 選択(画像) -->
        <div class="mb-3">
          <label for="formFile" class="form-label">画像</label>
          <input class="form-control" type="file" id="formFile" />
        </div>
        <img
          src="https://jp.techcrunch.com/wp-content/uploads/2021/11/twitter-2021-10-d-2.jpg?w=738"
          class="img-fluid"
          alt="..."
        />
      </div>
      <div class="card-footer text-muted">
        <button
          type="button"
          class="btn btn-success text-light me-2"
          @click="clickLogin"
        >
          登録
        </button>
        <button
          type="button"
          class="btn btn-secondary text-light"
          @click="clickLogin"
        >
          戻る
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, inject } from 'vue';
import { useRouter } from 'vue-router';
import { validaitonErrorsType } from '@/libs/type';
import {
  adminAuthenticationKey,
  useAdminAuthenticationType,
} from '@/composables/useAdminAuthentication';

export default defineComponent({
  setup() {
    const router = useRouter();
    const { login, getMe } = inject(
      adminAuthenticationKey
    ) as useAdminAuthenticationType;

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
