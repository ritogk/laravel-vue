import { InjectionKey, reactive, readonly, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import { validaitonErrorsType } from '@/libs/type';
import {
  User,
  AuthFrontApi,
  AuthFrontLoginPostRequest,
  AccessToken,
} from '@/open_api';

// メイン関数のtype
type useUserAuthenticationType = {
  userAuthenticationRefs: ToRefs<{ user: User }>;
  login(email: string, password: string): Promise<void | validaitonErrorsType>;
  refresh(): Promise<AccessToken>;
  getMe(): Promise<void>;
};

const authFrontApi = new AuthFrontApi(apiConfig);

// メイン関数
const useUserAuthentication = (): useUserAuthenticationType => {
  // 状態
  const state = reactive({ user: {} as User });

  // ログイン処理
  const login = async (
    email: string,
    password: string
  ): Promise<void | validaitonErrorsType> => {
    const request: AuthFrontLoginPostRequest = {
      requestLogin: { email: email, password: password },
    };
    try {
      // ログイン
      await authFrontApi.authFrontLoginPost(request);
      // ユーザーの情報を取得
      state.user = await authFrontApi.authFrontMeGet();
      return;
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };

  // アクセストークンのリフレッシュ
  const refresh = async (): Promise<AccessToken> => {
    const response = await authFrontApi.authFrontRefreshPost({});
    return response;
  };

  // ログイン済のユーザー情報を取得
  const getMe = async (): Promise<void> => {
    state.user = await authFrontApi.authFrontMeGet();
  };

  return {
    userAuthenticationRefs: toRefs(state),
    login: readonly(login),
    refresh: readonly(refresh),
    getMe: readonly(getMe),
  };
};

const userAuthenticationKey: InjectionKey<useUserAuthenticationType> =
  Symbol('UserAuthentication');
export {
  useUserAuthentication,
  useUserAuthenticationType,
  userAuthenticationKey,
};
