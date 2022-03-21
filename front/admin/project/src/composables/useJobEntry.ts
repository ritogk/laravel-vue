import { InjectionKey, reactive, ToRefs, toRefs } from 'vue';
import { apiConfig } from '@/libs/config';
import {
  EntryApi,
  ResponseJobEntry,
  EntriesGetRequest,
  Entry,
  Job,
} from '@/open_api';
import { useAdminAuthentication } from '@/composables/useAdminAuthentication';
import { validaitonErrorsType } from '@/libs/validation';

// メイン関数のtype
type useJobEntryType = {
  jobEntryRefs: ToRefs<{
    items: ResponseJobEntry[];
  }>;
  getJobEntries(
    jobId?: number,
    jobCategoryId?: number,
    userName?: string,
    selfPr?: string
  ): Promise<Array<ResponseJobEntry>>;
};

const entryApi = new EntryApi(apiConfig);

// メイン関数
const useJobEntry = (): useJobEntryType => {
  // 状態
  const state = reactive({
    items: Array<ResponseJobEntry>(),
  });

  /**
   * 応募された仕事の一覧を取得します。
   * @param jobId
   * @param jobCategoryId
   * @param userName
   * @param selfPr
   * @returns
   */
  const getJobEntries = async (
    jobId?: number,
    jobCategoryId?: number,
    userName?: string,
    selfPr?: string
  ): Promise<Array<ResponseJobEntry>> => {
    const queryParameters: EntriesGetRequest = {
      jobId: jobId,
      jobCategoryId: jobCategoryId,
      userName: userName,
      selfPr: selfPr,
    };
    const jobEntries = await entryApi.entriesGet(queryParameters);
    state.items.splice(0, state.items.length, ...jobEntries);
    return jobEntries;
  };

  return {
    jobEntryRefs: toRefs(state),
    getJobEntries: getJobEntries,
  };
};

const jobKey: InjectionKey<useJobEntryType> = Symbol('Job');
export { useJobEntry, useJobEntryType, jobKey };
