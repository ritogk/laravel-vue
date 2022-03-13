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
  state: ToRefs<{ member: User }>;
  login(
    email: string,
    password: string
  ): Promise<AccessToken | validaitonErrorsType>;
};

const authFrontApi = new AuthFrontApi(apiConfig);

// メイン関数
const useUserAuthentication = (): useUserAuthenticationType => {
  // 状態
  const state = reactive({ member: {} as User });
  // ログイン処理
  const login = async (
    email: string,
    password: string
  ): Promise<AccessToken | validaitonErrorsType> => {
    const request: AuthFrontLoginPostRequest = {
      requestLogin: { email: email, password: password },
    };
    try {
      return await authFrontApi.authFrontLoginPost(request);
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };

  return { state: toRefs(state), login: readonly(login) };
};

const injectionKey: InjectionKey<useUserAuthenticationType> = Symbol('Auth');
export { useUserAuthentication, useUserAuthenticationType, injectionKey };
