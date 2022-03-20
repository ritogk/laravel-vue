import { reactive, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import {
  JobCategorieApi,
  JobCategory,
  JobCategoriesGetRequest,
} from '@/open_api';

// メイン関数のtype
type useJobCategoryType = {
  jobCategoryRefs: ToRefs<{
    items: JobCategory[];
    names: { [key: number]: string };
  }>;
  getJobCategory(name?: string, content?: string): Promise<Array<JobCategory>>;
};

const jobCategorieApi = new JobCategorieApi(apiConfig);

// メイン関数
const useJobCategory = (): useJobCategoryType => {
  // 状態
  const state = reactive({
    items: Array<JobCategory>(),
    names: {} as { [key: number]: string },
  });

  /**
   * 職種一覧を取得します。
   * @param name
   * @param content
   * @returns
   */
  const getJobCategory = async (
    name?: string,
    content?: string
  ): Promise<Array<JobCategory>> => {
    const requestParameters: JobCategoriesGetRequest = {
      name: name,
      content: content,
    };
    const jobCategories = await jobCategorieApi.jobCategoriesGet(
      requestParameters
    );
    state.items.splice(0, state.items.length, ...jobCategories);
    generateNames();
    return jobCategories;
  };

  // id毎の職種一覧を取得
  const generateNames = (): void => {
    state.names = {};
    state.items.forEach((item) => {
      if (item.id !== undefined) {
        state.names[item.id] = item.name ?? '';
      }
    });
  };

  return {
    jobCategoryRefs: toRefs(state),
    getJobCategory: getJobCategory,
  };
};

export { useJobCategory };
