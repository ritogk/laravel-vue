import { InjectionKey, reactive, readonly, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import { User, UserApi, UsersPostRequest } from '@/open_api';

// メイン関数のtype
type useUserType = {
  registration(
    name: string,
    selfPr: string,
    tel: string,
    mail: string,
    pasword: string,
    passwordConfirm: string
  ): Promise<User>;
};

const userApi = new UserApi(apiConfig);

// メイン関数
const useUser = (): useUserType => {
  // 会員登録の処理
  const registration = async (
    name: string,
    selfPr: string,
    tel: string,
    mail: string,
    password: string,
    passwordConfirm: string
  ): Promise<User> => {
    const request: UsersPostRequest = {
      requestUser: {
        name: name,
        selfPr: selfPr,
        tel: tel,
        email: mail,
        password: password,
        passwordConfirmation: passwordConfirm,
      },
    };
    const response = await userApi.usersPost(request);
    return response;
  };
  return { registration: readonly(registration) };
};

const injectionKey: InjectionKey<useUserType> = Symbol('Auth');
export { useUser, useUserType, injectionKey };
