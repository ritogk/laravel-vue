<template>
  <!-- 検索ボックス -->
  <div class="w-25">
    <div class="card border-primary">
      <div class="card-header bg-primary text-white">検索</div>
      <div class="card-body">
        <!-- 入力(職種) -->
        <div class="mb-3">
          <label for="inputJobCategpryOd" class="form-label fs-6">職種</label>
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="condition.jobCategoryId"
          >
            <option value="">全て</option>
            <option
              v-for="(name, index) in jobCategoryNms"
              :key="`jobCategory${index}`"
              v-bind:value="index"
              v-text="name"
            ></option>
          </select>
        </div>
        <!-- 入力(仕事内容) -->
        <div class="mb-3">
          <label for="inputContent" class="form-label fs-6">仕事内容</label>
          <input
            type="text"
            class="form-control form-control-sm"
            id="inputContent"
            placeholder="どんな求人をお探しですか"
            v-model="condition.content"
          />
        </div>
        <!-- 入力(金額) -->
        <div class="mb-3">
          <label for="inputPrice" class="form-label fs-6">金額</label>
          <input
            type="number"
            class="form-control form-control-sm"
            id="inputPrice"
            placeholder="最低金額を入力してください"
            v-model="condition.price"
          />
        </div>
        <!-- 入力(注目の求人)-->
        <div class="form-check mb-2 mt-4">
          <input
            class="form-check-input"
            type="checkbox"
            value=""
            id="inputAttention"
            v-model="condition.attention"
          />
          <label class="form-check-label" for="inputAttention">
            注目の求人
          </label>
        </div>
        <!-- 検索-->
        <div class="mt-3">
          <button
            type="button"
            class="btn btn-primary w-100 text-light"
            @click="clickSearch"
          >
            検索
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, inject, reactive, PropType } from 'vue';
import { jobKey, useJobType } from '@/composables/useJob';
import { useJobCategory } from '@/composables/useJobCategory';

export default defineComponent({
  props: {
    jobCategoryId: Number as PropType<number | undefined>,
  },
  setup(props) {
    const { getJob } = inject(jobKey) as useJobType;
    const { jobCategoryRefs, getJobCategory } = useJobCategory();

    // セレクト用の職種一覧を取得
    getJobCategory();
    const jobCategoryNms = jobCategoryRefs.names;

    // 検索条件
    const condition = reactive({
      jobCategoryId: props.jobCategoryId,
      content: '',
      price: '',
      attention: false,
    });

    // 「検索」押下時 の処理
    const clickSearch = (): void => {
      getJob(
        condition.jobCategoryId ? condition.jobCategoryId : undefined,
        condition.content ? condition.content : undefined,
        condition.price ? Number(condition.price) : undefined,
        condition.attention
      );
    };

    // 仕事一覧を取得
    clickSearch();
    return { condition, clickSearch, jobCategoryNms };
  },
});
</script>
