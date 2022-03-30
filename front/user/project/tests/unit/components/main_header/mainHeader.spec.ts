import { nextTick } from 'vue';
import { flushPromises, mount, VueWrapper } from '@vue/test-utils';
import * as vueRouter from 'vue-router';
import {
  useUserAuthentication,
  userAuthenticationKey,
} from '@/composables/useUserAuthentication';
import { User } from '@/open_api';
import { userModel } from '~/utils/data/user';
// テスト対象のコンポーネント
import MainHeader from '@/components/MainHeader.vue';

describe('未ログイン状態での「MainHeader.vue」コンポーネントのテスト', () => {
  let wrapper: VueWrapper<any>;

  /**
   * 外部からの振る舞いを設定
   */
  beforeEach(async () => {
    // モックを作らないとなぜかエラーがでる
    jest
      .spyOn(vueRouter, 'useRouter')
      .mockImplementation((): any => ({ push: () => {} }));

    // 未ログイン状態のモックを作成する
    const objUseUserAuthentication = useUserAuthentication();
    objUseUserAuthentication.userAuthenticationRefs.isLogin.value = false;
    objUseUserAuthentication.userAuthenticationRefs.user.value = {} as User;

    // コンポーネントをレンダリング
    wrapper = mount(MainHeader, {
      global: {
        provide: {
          [userAuthenticationKey as symbol]: objUseUserAuthentication,
        },
      },
    });

    await flushPromises();
    await nextTick();
  });

  /**
   * 確認項目
   */
  it('スナップショットとの差分を確認する', async () => {
    expect(wrapper.element).toMatchSnapshot();
  });
});

describe('ログイン済状態での「MainHeader.vue」コンポーネントのテスト', () => {
  let wrapper: VueWrapper<any>;

  /**
   * 外部からの振る舞いを設定
   */
  beforeEach(async () => {
    // モックを作らないとなぜかエラーがでる
    jest
      .spyOn(vueRouter, 'useRouter')
      .mockImplementation((): any => ({ push: () => {} }));

    // ログイン済の状態のモックを作成する
    const objUseUserAuthentication = useUserAuthentication();
    objUseUserAuthentication.userAuthenticationRefs.isLogin.value = true;
    objUseUserAuthentication.userAuthenticationRefs.user.value = userModel;

    // コンポーネントをレンダリング
    wrapper = mount(MainHeader, {
      global: {
        provide: {
          [userAuthenticationKey as symbol]: objUseUserAuthentication,
        },
      },
    });

    await flushPromises();
    await nextTick();
  });

  /**
   * 確認項目
   */
  it('スナップショットとの差分を確認する', async () => {
    expect(wrapper.element).toMatchSnapshot();
  });
});
