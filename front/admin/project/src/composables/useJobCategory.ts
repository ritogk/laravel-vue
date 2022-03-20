import { reactive, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import { validaitonErrorsType } from '@/libs/type';
import {
  JobCategorieApi,
  JobCategory,
  JobCategoriesGetRequest,
  JobCategoriesPostRequest,
  JobCategoriesIdPutRequest,
} from '@/open_api';

// メイン関数のtype
type useJobCategoryType = {
  jobCategoryRefs: ToRefs<{
    items: JobCategory[];
    names: { [key: number]: string };
  }>;
  getJobCategories(
    name?: string,
    content?: string
  ): Promise<Array<JobCategory>>;
  findJobCategory(id: number): Promise<JobCategory>;
  createJobCategory(
    name: string,
    content: string,
    image: string,
    sortNo: number
  ): Promise<JobCategory | validaitonErrorsType>;
  updateJobCategory(
    id: number,
    name: string,
    content: string,
    image: string,
    sortNo: number
  ): Promise<JobCategory | validaitonErrorsType>;
  deleteJobCategory(id: number): Promise<JobCategory>;
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
  const getJobCategories = async (
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

  /**
   * id毎の職種一覧を取得
   */
  const generateNames = (): void => {
    state.names = {};
    state.items.forEach((item) => {
      if (item.id !== undefined) {
        state.names[item.id] = item.name ?? '';
      }
    });
  };

  /**
   * 職種を１件取得します。
   * @param id
   * @returns
   */
  const findJobCategory = async (id: number): Promise<JobCategory> => {
    return await jobCategorieApi.jobCategoriesIdGet({ id: id });
  };

  /**
   * 職種 新規登録
   * @param name
   * @param content
   * @param image
   * @param sortNo
   */
  const createJobCategory = async (
    name: string,
    content: string,
    image: string,
    sortNo: number
  ): Promise<JobCategory | validaitonErrorsType> => {
    const request: JobCategoriesPostRequest = {
      requestJobCategory: {
        name: name,
        content: content,
        image: image,
        sortNo: sortNo,
      },
    };
    try {
      return await jobCategorieApi.jobCategoriesPost(request);
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };

  /**
   * 職種 更新
   * @param id
   * @param name
   * @param content
   * @param image
   * @param sortNo
   * @returns
   */
  const updateJobCategory = async (
    id: number,
    name: string,
    content: string,
    image: string,
    sortNo: number
  ): Promise<JobCategory | validaitonErrorsType> => {
    const request: JobCategoriesIdPutRequest = {
      id: id,
      requestJobCategory: {
        name: name,
        content: content,
        image: image,
        sortNo: sortNo,
      },
    };
    try {
      return await jobCategorieApi.jobCategoriesIdPut(request);
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };

  /**
   * 職種 削除
   * @param id
   * @returns
   */
  const deleteJobCategory = async (id: number): Promise<JobCategory> => {
    return await jobCategorieApi.jobCategoriesIdDelete({ id: id });
  };

  return {
    jobCategoryRefs: toRefs(state),
    getJobCategories: getJobCategories,
    findJobCategory: findJobCategory,
    createJobCategory: createJobCategory,
    updateJobCategory: updateJobCategory,
    deleteJobCategory: deleteJobCategory,
  };
};

export { useJobCategory };
