<template>
  <!--ログインコンポーネント-->
  <Authenticator
    :social-providers="['google']"
    :sign-up-attributes="['email']"
    :form-fields="formFields"
  >
    <!-- サインイン後に表示する内容 -->
    <template v-slot="{ user, signOut }">
      <p>サインインしました！</p>
      <h1>Hello {{ user.username }}!</h1>
      <button @click="signOut">Sign Out</button>
    </template>
  </Authenticator>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import '@aws-amplify/ui-vue/styles.css';
import { Authenticator } from '@aws-amplify/ui-vue';

export default defineComponent({
  components: {
    Authenticator,
  },
  setup() {
    const formFields = {
      // [サインイン画面]
      signIn: {
        // ユーザー名
        username: {
          labelHidden: true,
          label: '',
          isRequired: true,
        },
        // パスワード
        password: {
          labelHidden: true,
          label: '',
          isRequired: true,
        },
      },
      // [サインアップ画面]
      signUp: {
        // ユーザー名
        username: {
          labelHidden: true,
          label: '',
          isRequired: true,
        },
        // パスワード
        password: {
          labelHidden: true,
          isRequired: true,
          label: '',
        },
        // メールアドレス
        email: {
          labelHidden: true,
          label: '',
          isRequired: true,
        },
      },
      // [サインアップ後に表示される検証コードを入力する画面]
      confirmSignUp: {
        // 検証コード
        confirmation_code: {
          labelHidden: true,
          label: '',
          isRequired: true,
        },
      },
      // [パスワードリセット画面]
      resetPassword: {
        // ユーザー名
        username: {
          labelHidden: true,
          label: '',
          isRequired: true,
        },
      },
      // [パスワードリセットで検証コードとパスワードを入力する画面]
      confirmResetPassword: {
        // 検証コード
        confirmation_code: {
          labelHidden: true,
          label: '',
          isRequired: true,
        },
      },
    };

    return { formFields };
  },
});
</script>
