import { InjectionKey, readonly } from 'vue';
import { apiConfig } from '@/libs/config';
import { validaitonErrorsType } from '@/libs/type';
import { User, UserApi, UsersPostRequest } from '@/open_api';

// メイン関数のtype
type useUserType = {
  registration(
    name: string,
    selfPr: string,
    tel: string,
    mail: string,
    pasword: string,
    passwordConfirmation: string
  ): Promise<User | validaitonErrorsType>;
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
    passwordConfirmation: string
  ): Promise<User | validaitonErrorsType> => {
    const request: UsersPostRequest = {
      requestUser: {
        name: name,
        selfPr: selfPr,
        tel: tel,
        email: mail,
        password: password,
        passwordConfirmation: passwordConfirmation,
      },
    };
    try {
      return await userApi.usersPost(request);
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };
  return { registration: registration };
};

const injectionKey: InjectionKey<useUserType> = Symbol('Auth');
export { useUser, useUserType, injectionKey };
