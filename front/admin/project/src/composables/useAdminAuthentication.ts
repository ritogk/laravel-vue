import { InjectionKey, reactive, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/openApi';
import { validaitonErrorsType } from '@/libs/validation';
import {
  Admin,
  AuthAdminApi,
  AuthAdminLoginPostRequest,
  AccessToken,
} from '@/open_api';

// メイン関数のtype
type useAdminAuthenticationType = {
  adminAuthenticationRefs: ToRefs<{ user: Admin; isLogin: boolean }>;
  login(email: string, password: string): Promise<void | validaitonErrorsType>;
  refresh(): Promise<AccessToken>;
  logout(): Promise<void>;
  getMe(): Promise<void>;
};

const authAdminApi = new AuthAdminApi(apiConfig);

// メイン関数
const useAdminAuthentication = (): useAdminAuthenticationType => {
  // 状態
  const state = reactive({ user: {} as Admin, isLogin: false });

  /**
   * ログイン処理
   * @param email
   * @param password
   * @returns
   */
  const login = async (
    email: string,
    password: string
  ): Promise<void | validaitonErrorsType> => {
    const request: AuthAdminLoginPostRequest = {
      requestLogin: { email: email, password: password },
    };
    try {
      // ログイン
      await authAdminApi.authAdminLoginPost(request);
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
    return await authAdminApi.authAdminRefreshPost({});
  };

  // ログアウト
  const logout = async (): Promise<void> => {
    await authAdminApi.authAdminLogoutPost({});
    state.isLogin = false;
    state.user = {} as Admin;
  };

  // ログイン済のユーザー情報を取得
  const getMe = async (): Promise<void> => {
    state.user = await authAdminApi.authAdminMeGet();
    state.isLogin = true;
  };

  return {
    adminAuthenticationRefs: toRefs(state),
    login: login,
    refresh: refresh,
    logout: logout,
    getMe: getMe,
  };
};

const adminAuthenticationKey: InjectionKey<useAdminAuthenticationType> = Symbol(
  'AdminAuthentication'
);
export {
  useAdminAuthentication,
  useAdminAuthenticationType,
  adminAuthenticationKey,
};
