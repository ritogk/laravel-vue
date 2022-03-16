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
            v-model="form.name"
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
            v-model="form.selfPr"
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
            v-model="form.tel"
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
            v-model="form.email"
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
            v-model="form.password"
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
            v-model="form.passwordConfirmation"
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
import { validaitonErrorsType } from '@/libs/type';

export default defineComponent({
  setup() {
    const { login } = inject(
      userAuthenticationKey
    ) as useUserAuthenticationType;

    const router = useRouter();

    // フォームの状態
    const form = reactive({
      name: '山田 太郎',
      selfPr: 'Excelがうまいです。',
      tel: '011-1111-1111',
      email: 'normal@normal.co.jp',
      password: 'normal',
      passwordConfirmation: 'normal',
    });
    // フォームのエラー内容
    const formErrors = reactive({
      name: '',
      selfPr: '',
      tel: '',
      email: '',
      password: '',
      passwordConfirmation: '',
    });

    // 「会員登録」ボタン押下
    const clickRegistration = async () => {
      // ユーザー登録を行う
      const response = await useUser().registration(
        form.name,
        form.selfPr,
        form.tel,
        form.email,
        form.password,
        form.passwordConfirmation
      );
      // 正常時の処理
      if (!('errors' in response)) {
        // ログイン
        await login(form.email, form.password);
        router.push('/');
        return;
      }

      // バリデーションで弾かれた場合の処理
      formErrors.name = '';
      formErrors.selfPr = '';
      formErrors.tel = '';
      formErrors.email = '';
      formErrors.password = '';
      formErrors.passwordConfirmation = '';
      const errors = (response as validaitonErrorsType).errors;
      if ('name' in errors) {
        formErrors.name = errors['name'][0];
      }
      if ('selfPr' in errors) {
        formErrors.selfPr = errors['selfPr'][0];
      }
      if ('tel' in errors) {
        formErrors.tel = errors['tel'][0];
      }
      if ('email' in errors) {
        formErrors.email = errors['email'][0];
      }
      if ('password' in errors) {
        formErrors.password = errors['password'][0];
      }
      if ('passwordConfirmation' in errors) {
        formErrors.passwordConfirmation = errors['passwordConfirmation'][0];
      }
    };

    return { form, formErrors, clickRegistration };
  },
});
</script>
