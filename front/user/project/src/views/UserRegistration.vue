<template>
  <div>
    <div class="card w-100 mx-auto border-primary">
      <div class="card-header bg-primary text-white">会員登録</div>
      <div class="card-body">
        <!-- 入力(氏名) -->
        <div class="mb-3">
          <label for="inputName" class="form-label fs-6">氏名</label>
          <input
            type="text"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.name !== '' ? 'is-invalid' : '']"
            id="inputName"
            placeholder="test@test.co.jp"
            aria-describedby="inputNameFeedback"
            v-model="formInputs.name"
          />
          <div
            id="inputNameFeedback"
            class="invalid-feedback"
            v-text="formErrors.name"
            v-show="formErrors.name !== ''"
          />
        </div>
        <!-- 入力(自己PR) -->
        <div class="mb-3">
          <label for="inputSelfPr" class="form-label fs-6">自己PR</label>
          <textarea
            class="form-control"
            v-bind:class="[formErrors.selfPr !== '' ? 'is-invalid' : '']"
            id="inputSelfPr"
            placeholder="Excelがうまいです。"
            aria-describedby="inputSelfPrFeedback"
            v-model="formInputs.selfPr"
            rows="3"
          ></textarea>
          <div
            id="inputSelfPrFeedback"
            class="invalid-feedback"
            v-text="formErrors.selfPr"
            v-show="formErrors.selfPr !== ''"
          />
        </div>
        <!-- 入力(電話番号) -->
        <div class="mb-3">
          <label for="inputTel" class="form-label fs-6">電話番号</label>
          <input
            type="text"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.tel !== '' ? 'is-invalid' : '']"
            id="inputTel"
            placeholder="011-1111-1111"
            aria-describedby="inputTelFeedback"
            v-model="formInputs.tel"
          />
          <div
            id="inputTelFeedback"
            class="invalid-feedback"
            v-text="formErrors.tel"
            v-show="formErrors.tel !== ''"
          />
        </div>
        <!-- 入力(メールアドレス) -->
        <div class="mb-3">
          <label for="inputEmail" class="form-label fs-6">メールアドレス</label>
          <input
            type="text"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.email !== '' ? 'is-invalid' : '']"
            id="inputEmail"
            placeholder="test@test.co.jp"
            aria-describedby="inputEmailFeedback"
            v-model="formInputs.email"
          />
          <div
            id="inputEmailFeedback"
            class="invalid-feedback"
            v-text="formErrors.email"
            v-show="formErrors.email !== ''"
          />
        </div>
        <!-- 入力(パスワード) -->
        <div class="mb-3">
          <label for="inputPassword" class="form-label fs-6">パスワード</label>
          <input
            type="password"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.password !== '' ? 'is-invalid' : '']"
            id="inputPassword"
            aria-describedby="inputPasswordFeedback"
            v-model="formInputs.password"
          />
          <div
            id="inputPasswordFeedback"
            class="invalid-feedback"
            v-text="formErrors.password"
            v-show="formErrors.password !== ''"
          />
        </div>
        <!-- 入力(パスワード_確認) -->
        <div class="mb-3">
          <label for="inputPasswordConfirmation" class="form-label fs-6"
            >パスワード(確認)</label
          >
          <input
            type="password"
            class="form-control form-control-sm"
            v-bind:class="[
              formErrors.passwordConfirmation !== '' ? 'is-invalid' : '',
            ]"
            id="inputPasswordConfirmation"
            aria-describedby="inputPasswordConfirmationFeedback"
            v-model="formInputs.passwordConfirmation"
          />
          <div
            id="inputPasswordConfirmationFeedback"
            class="invalid-feedback"
            v-text="formErrors.passwordConfirmation"
            v-show="formErrors.passwordConfirmation !== ''"
          />
        </div>
        <!-- 会員登録-->
        <div class="mt-3">
          <button
            type="button"
            class="btn btn-primary w-100 text-light"
            @click="clickRegistration"
          >
            会員登録
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, inject } from 'vue';
import { useRouter } from 'vue-router';
import { useUser } from '@/composables/useUser';
import {
  useUserAuthenticationType,
  userAuthenticationKey,
} from '@/composables/useUserAuthentication';

export default defineComponent({
  setup() {
    const { login, getMe } = inject(
      userAuthenticationKey
    ) as useUserAuthenticationType;

    const router = useRouter();

    // フォームの状態
    const formRefs = reactive({
      // 入力値
      inputs: {
        name: '山田 太郎',
        selfPr: 'Excelがうまいです。',
        tel: '011-1111-1111',
        email: 'normal@normal.co.jp',
        password: 'normal',
        passwordConfirmation: 'normal',
      },
      // エラーメッセージ
      errors: {
        name: '',
        selfPr: '',
        tel: '',
        email: '',
        password: '',
        passwordConfirmation: '',
        general: '',
      },
    });

    // 「会員登録」ボタン押下
    const clickRegistration = async () => {
      // ユーザー登録を行う
      const response = await useUser().registration(
        formRefs.inputs.name,
        formRefs.inputs.selfPr,
        formRefs.inputs.tel,
        formRefs.inputs.email,
        formRefs.inputs.password,
        formRefs.inputs.passwordConfirmation
      );
      // 正常時の処理
      if (!('errors' in response)) {
        // ログイン
        await login(formRefs.inputs.email, formRefs.inputs.password);
        await getMe();
        router.push('/');
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
      clickRegistration,
    };
  },
});
</script>
