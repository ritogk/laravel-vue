import { InjectionKey, reactive, ToRefs, toRefs } from 'vue';
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
  userAuthenticationRefs: ToRefs<{ user: User; isLogin: boolean }>;
  login(email: string, password: string): Promise<void | validaitonErrorsType>;
  refresh(): Promise<AccessToken>;
  logout(): Promise<void>;
  getMe(): Promise<void>;
};

const authFrontApi = new AuthFrontApi(apiConfig);

// メイン関数
const useUserAuthentication = (): useUserAuthenticationType => {
  // 状態
  const state = reactive({ user: {} as User, isLogin: false });

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
      // eslint-disable-next-line
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };

  // アクセストークンのリフレッシュ
  const refresh = async (): Promise<AccessToken> => {
    return [] as AccessToken;
    // const response = await authFrontApi.authFrontRefreshPost({});
    // return response;
  };

  // ログアウト
  const logout = async (): Promise<void> => {
    try {
      await authFrontApi.authFrontLogoutPost({});
      // eslint-disable-next-line
    } catch (err: any) {
      if (err.status !== 401) return;
      // リフレッシュトークン更新
      await refresh();
      state.user = await authFrontApi.authFrontMeGet();
    }
    state.isLogin = false;
    state.user = {} as User;
  };

  // ログイン済のユーザー情報を取得
  const getMe = async (): Promise<void> => {
    try {
      state.user = await authFrontApi.authFrontMeGet();
      // eslint-disable-next-line
    } catch (err: any) {
      if (err.status !== 401) return;
      // リフレッシュトークン更新
      await refresh();
      state.user = await authFrontApi.authFrontMeGet();
    }
    state.isLogin = true;
  };

  return {
    userAuthenticationRefs: toRefs(state),
    login: login,
    refresh: refresh,
    logout: logout,
    getMe: getMe,
  };
};

const userAuthenticationKey: InjectionKey<useUserAuthenticationType> =
  Symbol('UserAuthentication');
export {
  useUserAuthentication,
  useUserAuthenticationType,
  userAuthenticationKey,
};
