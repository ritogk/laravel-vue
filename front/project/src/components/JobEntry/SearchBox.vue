<template>
  <!-- 検索ボックス -->
  <div class="w-25">
    <div class="card">
      <div class="card-header bg-primary text-white">検索</div>
      <div class="card-body">
        <!-- 入力(職種) -->
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label fs-6"
            >職種</label
          >
          <select class="form-select" aria-label="Default select example">
            <option selected>全て</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <!-- 入力(仕事内容) -->
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label fs-6"
            >仕事内容</label
          >
          <input
            type="email"
            class="form-control form-control-sm"
            id="exampleFormControlInput1"
            placeholder="どんな求人をお探しですか"
          />
        </div>
        <!-- 入力(金額) -->
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label fs-6"
            >金額</label
          >
          <input
            type="email"
            class="form-control form-control-sm"
            id="exampleFormControlInput1"
            placeholder="最低金額を入力してください"
          />
        </div>
        <!-- 入力(注目の求人)-->
        <div class="form-check mb-2 mt-4">
          <input
            class="form-check-input"
            type="checkbox"
            value=""
            id="flexCheckDefault"
          />
          <label class="form-check-label" for="flexCheckDefault">
            注目の求人
          </label>
        </div>
        <!-- 検索-->
        <div class="mt-3">
          <button type="button" class="btn btn-primary w-100 text-light">
            検索
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  setup() {
    return {};
  },
});
</script>
