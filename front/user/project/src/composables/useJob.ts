import { InjectionKey, reactive, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import { JobApi, Job, JobsGetRequest, Entry, EntryApi } from '@/open_api';
import { useUserAuthentication } from '@/composables/useUserAuthentication';

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

  // 仕事に対しての申込
  const entryJob = async (jobId: number, userId: number): Promise<Entry> => {
    try {
      return await entryApi.entriesPost({
        requestEntry: { jobId: jobId, userId: userId },
      });
      // eslint-disable-next-line
    } catch (err: any) {
      if (err.status !== 401) return {};
      // リフレッシュトークン更新
      await useUserAuthentication().refresh();
      return await entryApi.entriesPost({
        requestEntry: { jobId: jobId, userId: userId },
      });
    }
  };

  return {
    jobRefs: toRefs(state),
    getJob: getJob,
    entryJob: entryJob,
  };
};

const jobKey: InjectionKey<useJobType> = Symbol('Job');
export { useJob, useJobType, jobKey };
