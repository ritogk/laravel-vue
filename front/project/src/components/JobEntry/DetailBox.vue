<style scoped>
/* 改行 */
.multiple {
  white-space: pre-wrap;
}
</style>

<template>
  <div class="modal-header bg-primary">
    <h5 class="modal-title text-white" id="modalLabel">{{ job?.title }}</h5>
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="modal"
      aria-label="Close"
    ></button>
  </div>
  <div class="modal-body">
    <div class="card">
      <img
        :src="`https://business-textbooks.com/btextbooks/wp-content/uploads/2020/02/3854adc57415272a6dbdaf4017e4d6b4-135.jpg`"
        class="card-img-top"
      />
      <div class="card-body">
        <div>
          <h1>{{ job?.title }}</h1>
        </div>
        <div class="py-3">
          <h3>仕事内容</h3>
          <span class="multiple">{{ job?.content }}</span>
        </div>
        <div class="py-3">
          <h3>金額</h3>
          <span>{{ job ?? convertComma(job?.price) }}円~ </span>
        </div>
        <div class="py-3">
          <h3>福利厚生</h3>
          <span class="multiple">{{ job?.welfare }}</span>
        </div>
        <div class="py-3">
          <h3>休日</h3>
          <span class="multiple">{{ job?.holiday }}</span>
        </div>

        <div class="py-2">
          <button
            type="button"
            class="btn btn-primary w-100 text-light"
            @click="clickEntry"
          >
            申し込む
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Modal } from 'bootstrap';
import { Job } from '@/open_api';
import { convertComma } from '@/libs/utils';
export default defineComponent({
  props: {
    modalInfo: Object as PropType<{ object: Modal; job: Job }>,
  },
  setup(props) {
    // 「申し込み」押下時
    const clickEntry = () => {
      props.modalInfo?.object.hide();
    };
    return { job: props.modalInfo?.job, convertComma, clickEntry };
  },
});
</script>
