import { InjectionKey, reactive, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import {
  JobApi,
  Job,
  JobsGetRequest,
  JobsPostRequest,
  JobsIdPutRequest,
  Entry,
  EntryApi,
} from '@/open_api';
import { useAdminAuthentication } from '@/composables/useAdminAuthentication';
import { validaitonErrorsType } from '@/libs/validation';

// メイン関数のtype
type useJobType = {
  jobRefs: ToRefs<{
    items: Job[];
  }>;
  getJobs(
    title?: string,
    jobCategoryId?: number,
    content?: string,
    price?: number,
    attention?: boolean
  ): Promise<Array<Job>>;
  findJob(id: number): Promise<Job>;
  createJob(
    title: string,
    content: string,
    attention: boolean,
    jobCategoryId: number,
    price: number,
    image: string,
    sortNo: number,
    welfare?: string,
    holiday?: string
  ): Promise<Job | validaitonErrorsType>;
  updateJob(
    id: number,
    title: string,
    content: string,
    attention: boolean,
    jobCategoryId: number,
    price: number,
    image: string,
    sortNo: number,
    welfare?: string,
    holiday?: string
  ): Promise<Job | validaitonErrorsType>;
  deleteJob(id: number): Promise<Job>;
  entryJob(jobId: number, userId: number): Promise<Entry>;
};

const jobApi = new JobApi(apiConfig);
const entryApi = new EntryApi(apiConfig);

// メイン関数
const useJob = (): useJobType => {
  // 状態
  const state = reactive({
    items: Array<Job>(),
  });

  /**
   * 仕事の一覧を取得します。
   * @param title
   * @param jobCategoryId
   * @param content
   * @param price
   * @param attention
   * @returns
   */
  const getJobs = async (
    title?: string,
    jobCategoryId?: number,
    content?: string,
    price?: number,
    attention?: boolean
  ): Promise<Array<Job>> => {
    const queryParameters: JobsGetRequest = {
      jobCategoryId: jobCategoryId,
      content: content,
      price: price,
      attention: attention,
    };
    const jobs = await jobApi.jobsGet(queryParameters);
    state.items.splice(0, state.items.length, ...jobs);
    return jobs;
  };

  /**
   * 仕事を１件取得します。
   * @param id
   * @returns
   */
  const findJob = async (id: number): Promise<Job> => {
    return await jobApi.jobsIdGet({ id: id });
  };

  /**
   * 仕事 新規登録
   * @param name
   * @param content
   * @param image
   * @param sortNo
   */
  const createJob = async (
    title: string,
    content: string,
    attention: boolean,
    jobCategoryId: number,
    price: number,
    image: string,
    sortNo: number,
    welfare?: string,
    holiday?: string
  ): Promise<Job | validaitonErrorsType> => {
    const request: JobsPostRequest = {
      requestJob: {
        title: title,
        content: content,
        attention: attention,
        jobCategoryId: jobCategoryId,
        price: price,
        image: image,
        sortNo: sortNo,
        welfare: welfare,
        holiday: holiday,
      },
    };
    try {
      return await jobApi.jobsPost(request);
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };

  /**
   * 仕事 更新
   * @param id
   * @param title
   * @param content
   * @param attention
   * @param jobCategoryId
   * @param price
   * @param image
   * @param sortNo
   * @param welfare
   * @param holiday
   * @returns
   */
  const updateJob = async (
    id: number,
    title: string,
    content: string,
    attention: boolean,
    jobCategoryId: number,
    price: number,
    image: string,
    sortNo: number,
    welfare?: string,
    holiday?: string
  ): Promise<Job | validaitonErrorsType> => {
    const request: JobsIdPutRequest = {
      id: id,
      requestJob: {
        title: title,
        content: content,
        attention: attention,
        jobCategoryId: jobCategoryId,
        price: price,
        image: image,
        sortNo: sortNo,
        welfare: welfare,
        holiday: holiday,
      },
    };
    try {
      return await jobApi.jobsIdPut(request);
    } catch (err: any) {
      const json = await err.json();
      return Promise.resolve({
        errors: json.errors,
      } as validaitonErrorsType);
    }
  };

  /**
   * 仕事 削除
   * @param id
   * @returns
   */
  const deleteJob = async (id: number): Promise<Job> => {
    return await jobApi.jobsIdDelete({ id: id });
  };

  /**
   * 仕事に対して申し込みを行います。
   * @param jobId
   * @param userId
   * @returns
   */
  const entryJob = async (jobId: number, userId: number): Promise<Entry> => {
    try {
      return await entryApi.entriesPost({
        requestEntry: { jobId: jobId, userId: userId },
      });
    } catch (err: any) {
      if (err.status !== 401) return {};
      // リフレッシュトークン更新
      await useAdminAuthentication().refresh();
      return await entryApi.entriesPost({
        requestEntry: { jobId: jobId, userId: userId },
      });
    }
  };

  return {
    jobRefs: toRefs(state),
    getJobs: getJobs,
    findJob: findJob,
    createJob: createJob,
    updateJob: updateJob,
    deleteJob: deleteJob,
    entryJob: entryJob,
  };
};

const jobKey: InjectionKey<useJobType> = Symbol('Job');
export { useJob, useJobType, jobKey };
