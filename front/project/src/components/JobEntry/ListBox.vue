<style scoped>
/* トリミング外枠 */
.trim {
  overflow: hidden;
  width: 100%;
  height: 300px;
  position: relative;
}
/* 横幅に合わせてリサイズ、はみ出た分をトリミング */
.trim_img {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  width: 100%;
  height: auto;
}
/* 仕事内容 */
.job_content {
  white-space: pre-wrap;
}
/* 注目の求人 */
.job_attention {
  padding: 1px 3px;
  border: solid 1px #ffda45;
  background: #ffda45;
  color: #333;
  text-align: left;
  width: 13%;
}
</style>

<template>
  <!-- 一覧ボックス -->
  <div class="w-75 ps-3">
    <VueElementLoading :active="loading" spinner="ring" size="50" />
    <div
      v-for="(job, index) in jobs"
      :key="`job-${index}`"
      class="card mb-3 border-primary"
    >
      <div class="card-header bg-primary text-white" v-text="job.title"></div>
      <div class="trim">
        <img :src="job.imageUrl" class="card-img-top trim_img" />
      </div>
      <div class="card-body">
        <div class="px-1">
          <div v-show="job.attention">
            <p class="job_attention">★注目の求人</p>
          </div>
          <p class="job_content" v-text="job.content"></p>
          <p class="job_content">
            {{ job.price !== undefined ? convertComma(job.price) : '' }}円~
          </p>
          <div v-show="isLogin" @click="clickJob(job)">
            <button
              type="button"
              class="btn btn-primary w-100 text-light"
              @click="clickSearch"
            >
              この求人に応募する
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- モーダル表示エリア -->
    <div
      class="modal fade"
      id="modalJobDetail"
      tabindex="-1"
      aria-labelledby="modalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <DetailBox :modalInfo="modalInfo" />
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import VueElementLoading from 'vue-element-loading';
import { defineComponent, inject, reactive, onMounted, ref } from 'vue';
import DetailBox from '@/components/JobEntry/DetailBox.vue';
import { jobKey, useJobType } from '@/composables/useJob';
import {
  userAuthenticationKey,
  useUserAuthenticationType,
} from '@/composables/useUserAuthentication';
import { convertComma } from '@/libs/utils';
import { Job } from '@/open_api';
import { Modal } from 'bootstrap';

export default defineComponent({
  components: {
    DetailBox,
    VueElementLoading,
  },
  setup() {
    const { jobRefs } = inject(jobKey) as useJobType;
    const { userAuthenticationRefs } = inject(
      userAuthenticationKey
    ) as useUserAuthenticationType;

    const isLogin = userAuthenticationRefs.isLogin;
    const jobs = jobRefs.items;
    const loading = ref(true);

    // 仕事詳細のモーダル情報
    const modalInfo = reactive({
      object: {} as Modal,
      job: {} as Job,
    });
    onMounted(() => {
      modalInfo.object = new Modal('#modalJobDetail', {
        keyboard: false,
      });
      setTimeout(function () {
        loading.value = false;
      }, 1000);
    });

    // 「仕事」カードのクリック時
    const clickJob = (job: Job) => {
      modalInfo.job.id = job.id;
      modalInfo.job.title = job.title;
      modalInfo.job.content = job.content;
      modalInfo.job.price = job.price;
      modalInfo.job.jobCategoryId = job.jobCategoryId;
      modalInfo.job.welfare = job.welfare;
      modalInfo.job.holiday = job.holiday;
      modalInfo.job.imageUrl = job.imageUrl;
      modalInfo.object.show();
    };
    return { jobs, clickJob, convertComma, modalInfo, loading, isLogin };
  },
});
</script>
