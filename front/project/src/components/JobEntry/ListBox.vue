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
  text-align: center;
}
</style>

<template>
  <!-- 一覧ボックス -->
  <div class="w-75 ps-3">
    <div
      v-for="(job, index) in jobs"
      :key="`job-${index}`"
      @click="clickJob(job)"
      class="card mb-3"
    >
      <div class="card-header bg-primary text-white" v-text="job.title"></div>
      <div class="trim">
        <img
          :src="`https://business-textbooks.com/btextbooks/wp-content/uploads/2020/02/3854adc57415272a6dbdaf4017e4d6b4-135.jpg`"
          class="card-img-top trim_img"
        />
      </div>
      <div class="card-body">
        <div class="px-1">
          <p class="job_content" v-text="job.content"></p>
          <p class="job_content" v-text="`${convertComma(job.price)}円~`"></p>
          <div v-show="job.attention">
            <p class="job_attention">注目の求人</p>
          </div>
          <a href="#" class="stretched-link"></a>
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
import { defineComponent, inject, reactive, onMounted } from 'vue';
import DetailBox from '@/components/JobEntry/DetailBox.vue';
import { jobKey, useJobType } from '@/composables/useJob';
import { convertComma } from '@/libs/utils';
import { Job } from '@/open_api';
import { Modal } from 'bootstrap';

export default defineComponent({
  components: {
    DetailBox,
  },
  setup() {
    const { jobRefs } = inject(jobKey) as useJobType;
    const jobs = jobRefs.items;

    // 仕事詳細のモーダル情報
    const modalInfo = reactive({
      object: {} as Modal,
      job: {} as Job,
    });
    onMounted(() => {
      modalInfo.object = new Modal('#modalJobDetail', {
        keyboard: false,
      });
    });

    // 「仕事」エリアをクリックした場合
    const clickJob = (job: Job) => {
      modalInfo.job.title = job.title;
      modalInfo.job.content = job.content;
      modalInfo.job.price = job.price;
      modalInfo.job.jobCategoryId = job.jobCategoryId;
      modalInfo.job.welfare = job.welfare;
      modalInfo.job.holiday = job.holiday;
      modalInfo.job.imageUrl = job.imageUrl;
      modalInfo.object.show();
    };
    return { jobs, clickJob, convertComma, modalInfo };
  },
});
</script>
