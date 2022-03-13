<template>
  <div>
    <div class="card w-100 mx-auto">
      <div class="card-header bg-primary text-white">会員登録</div>
      <div class="card-body">
        <!-- 入力(氏名) -->
        <div class="mb-3">
          <label for="inputName" class="form-label fs-6">氏名</label>
          <input
            type="text"
            class="form-control form-control-sm"
            id="inputName"
            placeholder="test@test.co.jp"
            v-model="form.name"
          />
        </div>
        <!-- 入力(自己PR) -->
        <div class="mb-3">
          <label for="inputSelfPr" class="form-label fs-6">自己PR</label>
          <textarea
            class="form-control"
            id="inputSelfPr"
            placeholder="Excelがうまいです。"
            v-model="form.selfPr"
            rows="3"
          ></textarea>
        </div>
        <!-- 入力(電話番号) -->
        <div class="mb-3">
          <label for="inputTel" class="form-label fs-6">電話番号</label>
          <input
            type="text"
            class="form-control form-control-sm"
            id="inputTel"
            placeholder="011-1111-1111"
            v-model="form.tel"
          />
        </div>
        <!-- 入力(メールアドレス) -->
        <div class="mb-3">
          <label for="inputMail" class="form-label fs-6">メールアドレス</label>
          <input
            type="text"
            class="form-control form-control-sm"
            id="inputMail"
            placeholder="test@test.co.jp"
            v-model="form.mail"
          />
        </div>
        <!-- 入力(パスワード) -->
        <div class="mb-3">
          <label for="inputPassword" class="form-label fs-6">パスワード</label>
          <input
            type="password"
            class="form-control form-control-sm"
            id="inputPassword"
            v-model="form.password"
          />
        </div>
        <!-- 入力(パスワード_確認) -->
        <div class="mb-3">
          <label for="inputPasswordConfirm" class="form-label fs-6"
            >パスワード(確認)</label
          >
          <input
            type="password"
            class="form-control form-control-sm"
            id="inputPasswordConfirm"
            v-model="form.passwordConfirm"
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
import { defineComponent, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useUser } from '@/composables/useUser';
import { useUserAuthentication } from '@/composables/useUserAuthentication';

export default defineComponent({
  setup() {
    const router = useRouter();
    // フォームの状態
    const form = reactive({
      name: '山田 太郎',
      selfPr: 'Excelがうまいです。',
      tel: '011-1111-1111',
      mail: 'normal@normal.co.jp',
      password: 'normal',
      passwordConfirm: 'normal',
    });

    // 「会員登録」ボタン押下
    const clickRegistration = async () => {
      // ユーザー登録
      await useUser().registration(
        form.name,
        form.selfPr,
        form.tel,
        form.mail,
        form.password,
        form.passwordConfirm
      );
      // ログイン
      await useUserAuthentication().login(form.mail, form.password);
      router.push('/');
    };

    return { form, clickRegistration };
  },
});
</script>
