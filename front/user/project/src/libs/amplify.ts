// class MyStorage {
//   // the promise returned from sync function
//   static syncPromise = null;
//   // set item with the key
//   static setItem(key: string, value: string): string {
//     // ここで api側にトークンを送ってhttponly属性が付与されたトークンを返す
//     localStorage.setItem(key, value);
//     return value;
//   }
//   // get item with the key
//   static getItem(key: string): string {
//     debugger;
//     let a: any = [];
//     while (a != []) {
//       if (a == []) {
//         useJobCategory()
//           .getJobCategory()
//           .then((args) => {
//             a = args;
//           });
//       }
//     }

//     debugger;
//     return localStorage.getItem(key) ?? '';
//   }
//   // remove item with the key
//   static removeItem(key: string): void {
//     // 削除用APIを呼び出す。
//     localStorage.removeItem(key);
//   }
//   // clear out the storage
//   static clear(): void {
//     // トークン全削除
//     return;
//   }
//   // // If the storage operations are async(i.e AsyncStorage)
//   // // Then you need to sync those items into the memory in this method
//   // static sync(): Promise<void> {
//   //   if (!MyStorage.syncPromise) {
//   //     MyStorage.syncPromise = new Promise((res, rej) => {});
//   //   }
//   //   return MyStorage.syncPromise;
//   // }
// }

const config = {
  Auth: {
    region: process.env.VUE_APP_COGNITO_AWS_REGION,
    userPoolId: process.env.VUE_APP_COGNITO_AWS_USER_POOL_ID,
    userPoolWebClientId:
      process.env.VUE_APP_COGNITO_AWS_USER_POOL_WEB_CLIENT_ID,
    oauth: {
      domain: process.env.VUE_APP_COGNITO_AWS_COGNITO_DOMAIN,
      scope: ['profile', 'email', 'openid'],
      redirectSignIn: process.env.VUE_APP_COGNITO_AWS_SIGN_IN_URL,
      redirectSignOut: process.env.VUE_APP_COGNITO_AWS_SIGN_OUT_URL,
      responseType: 'code',
    },
    //storage: MyStorage,
  },
};

/**
 * 多言語用の辞書
 * github.com/aws-amplify/amplify-ui/tree/main/packages/ui/src/i18n/dictionaries/authenticator
 */
const i18Dict = {
  ja: {
    // 項目
    'Sign Up with Google': 'Googleでサインアップ',
    'We Emailed You': 'メールをお送りしました',
    'Your code is on the way. To log in, enter the code we emailed to':
      'メールアドレスに送られた検証コードを入力して下さい。',
    'It may take a minute to arrive.': '受信までに数分かかる場合があります。',
    'Enter your code': '検証コードを入力して下さい。',
    'Enter your username': 'ユーザー名を入力して下さい。',
    'Reset your Password': 'パスワードをリセットします',
    Code: 'コード',
    // バリデーション関係
    "1 validation error detected: Value at 'password' failed to satisfy constraint: Member must have length greater than or equal to 6":
      'パスワードは8文字以上にしてください',
    "2 validation errors detected: Value at 'password' failed to satisfy constraint: Member must have length greater than or equal to 6; Value at 'password' failed to satisfy constraint: Member must satisfy regular expression pattern: ^[\\S]+.*[\\S]+$":
      'パスワードは8文字以上にしてください',
    'Account recovery requires verified contact information':
      'コンタクトの情報を検証する為に、アカウントの回復が必要です',
    'An account with the given email already exists.':
      'このメールアドレスはすでに登録されています',
    'Custom auth lambda trigger is not configured for the user pool.':
      'パスワードが入力されていません',
    'Cannot reset password for the user as there is no registered/verified email or phone_number':
      'メールアドレスや電話番号が登録されていないため、ユーザーのパスワードをリセットできません。',
    'Incorrect username or password.': 'ユーザー名またはパスワードが異なります',
    'Invalid password format': 'パスワードのフォーマットが無効です',
    'Invalid verification code provided, please try again.':
      '無効な確認コードです。再度ご確認ください',
    'Password cannot be empty': 'パスワードを入力してください',
    'Password did not conform with policy: Password not long enough':
      'パスワードは8文字以上にしてください',
    'User does not exist': 'ユーザーが存在しません',
    'User does not exist.': 'ユーザーが存在しません',
    'Username cannot be empty': 'ユーザー名を入力してください',
    'Your passwords must match': '確認用パスワードが一致しません',
  },
};

export { config, i18Dict };
