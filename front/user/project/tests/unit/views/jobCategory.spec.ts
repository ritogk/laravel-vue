import { nextTick } from 'vue';
import { flushPromises, mount, VueWrapper } from '@vue/test-utils';
import * as vueRouter from 'vue-router';
import { JobCategorieApi } from '@/open_api';
import { jobCategoryModel1, jobCategoryModel2 } from '~/utils/data/jobCategory';
// テスト対象のコンポーネント
import JobCategory from '@/views/JobCategory.vue';

describe('職種選択画面で正しい内容が表示されているか', () => {
  let wrapper: VueWrapper<any>;

  /**
   * 外部からの振る舞いを設定
   */
  beforeEach(async () => {
    // モックを作らないとなぜかエラーがでる
    jest
      .spyOn(vueRouter, 'useRouter')
      .mockImplementation((): any => ({ push: () => {} }));

    // 職種一覧取得関数のモックを作成
    jest
      .spyOn(JobCategorieApi.prototype, 'jobCategoriesGet')
      .mockImplementation(() =>
        Promise.resolve([jobCategoryModel1, jobCategoryModel2])
      );

    // コンポーネントをレンダリング
    wrapper = mount(JobCategory);

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
