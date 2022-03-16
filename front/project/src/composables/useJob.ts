import { InjectionKey, reactive, readonly, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import { JobApi, Job, JobsGetRequest } from '@/open_api';

// メイン関数のtype
type useJobType = {
  jobRefs: ToRefs<{
    items: Job[];
  }>;
  getJob(
    jobCategoryId?: number,
    content?: string,
    price?: number,
    attention?: boolean
  ): Promise<Array<Job>>;
};

const jobApi = new JobApi(apiConfig);

// メイン関数
const useJob = (): useJobType => {
  // 状態
  const state = reactive({
    items: Array<Job>(),
  });

  // 仕事一覧の取得
  const getJob = async (
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

  return {
    jobRefs: toRefs(state),
    getJob: readonly(getJob),
  };
};

const jobKey: InjectionKey<useJobType> = Symbol('Job');
export { useJob, useJobType, jobKey };
