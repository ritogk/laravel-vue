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
      class="card"
      data-bs-toggle="modal"
      data-bs-target="#modalJobDetail"
      data-bs-whatever="@getbootstrap"
    >
      <div class="card-header bg-primary text-white">プログラマー募集</div>
      <div class="trim">
        <img
          :src="`https://business-textbooks.com/btextbooks/wp-content/uploads/2020/02/3854adc57415272a6dbdaf4017e4d6b4-135.jpg`"
          class="card-img-top trim_img"
        />
      </div>
      <div class="card-body">
        <div class="px-1">
          <p class="job_content">良い仕事です</p>
          <p class="job_content">10000円</p>
          <div>
            <p class="job_attention">注目の求人</p>
          </div>

          <a
            href="#"
            @click.prevent="openDetail(job)"
            class="stretched-link"
          ></a>
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
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="modalLabel">
              プログラマー募集!!
            </h5>
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
                  <button type="button" class="btn btn-primary w-100">
                    申し込む
                  </button>
                </div>
              </div>
            </div>
          </div>
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
    // const click_job = () => {
    //   new bootstrap.Modal(document.getElementById('myModal'), {
    //     keyboard: false,
    //   });
    // };
    const flg = false;
    return { flg };
  },
});
</script>
