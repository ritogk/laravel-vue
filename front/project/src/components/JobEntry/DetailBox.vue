<template>
  <div class="modal-header bg-primary">
    <h5 class="modal-title text-white" id="modalLabel">プログラマー募集!!</h5>
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
          <h1>プログラマー募集!!</h1>
        </div>
        <div class="py-3">
          <h3>仕事内容</h3>
          <span class="multiple"></span>
        </div>
        <div class="py-3">
          <h3>金額</h3>
          <span></span>
        </div>
        <div class="py-3">
          <h3>福利厚生</h3>
          <span class="multiple"></span>
        </div>
        <div class="py-3">
          <h3>休日</h3>
          <span class="multiple"></span>
        </div>

        <div class="py-2">
          <button type="button" class="btn btn-primary w-100">申し込む</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import 'bootstrap';
export default defineComponent({
  setup() {
    const flg = false;
    return { flg };
  },
});
</script>
