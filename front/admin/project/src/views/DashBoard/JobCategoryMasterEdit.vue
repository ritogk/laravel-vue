<template>
  <div class="w-100">
    <h1 class="h2 mb-3">職種マスタ(編集)</h1>
    <div class="card w-100 mx-auto">
      <div class="card-header">ログイン</div>
      <div class="card-body">
        <!-- 入力(名称) -->
        <div class="mb-3">
          <label for="inputName" class="form-label">名称</label>
          <input
            type="text"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.name !== '' ? 'is-invalid' : '']"
            id="inputName"
            aria-describedby="inputNameFeedback"
            v-model="form.name"
            placeholder="名称を入力して下さい。"
          />
          <div
            id="inputNameFeedback"
            class="invalid-feedback"
            v-text="formErrors.name"
            v-show="formErrors.name !== ''"
          />
        </div>
        <!-- 入力(内容) -->
        <div class="mb-3">
          <label for="inputContent" class="form-label">内容</label>
          <textarea
            class="form-control form-control-sm"
            v-bind:class="[formErrors.content !== '' ? 'is-invalid' : '']"
            id="inputContent"
            aria-describedby="inputContentFeedback"
            v-model="form.content"
            placeholder="内容を入力して下さい。"
            rows="5"
          />
          <div
            id="inputContentFeedback"
            class="invalid-feedback"
            v-text="formErrors.content"
            v-show="formErrors.content !== ''"
          />
        </div>
        <!-- 入力(並び順) -->
        <div class="mb-3">
          <label for="inputSortNo" class="form-label">並び順</label>
          <input
            type="number"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.sortNo !== '' ? 'is-invalid' : '']"
            id="inputSortNo"
            aria-describedby="inputSortNoFeedback"
            v-model="form.sortNo"
            placeholder="並び順を入力して下さい。"
          />
          <div
            id="inputSortNoFeedback"
            class="invalid-feedback"
            v-text="formErrors.sortNo"
            v-show="formErrors.sortNo !== ''"
          />
        </div>
        <!-- 選択(画像) -->
        <div class="mb-3">
          <label for="inputImage" class="form-label">画像</label>
          <input
            class="form-control"
            v-bind:class="[formErrors.image !== '' ? 'is-invalid' : '']"
            type="file"
            id="inputImage"
            aria-describedby="inputImageFeedback"
            @change="uploadFile"
          />
          <div
            id="inputImageFeedback"
            class="invalid-feedback"
            v-text="formErrors.image"
            v-show="formErrors.image !== ''"
          />
        </div>
        <img :src="form.url" class="img-fluid" alt="..." v-show="form.url" />
      </div>
      <div class="card-footer text-muted">
        <button
          type="button"
          class="btn btn-success text-light me-2"
          @click="clickEntry"
        >
          登録
        </button>
        <button type="button" class="btn btn-secondary text-light">戻る</button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, inject } from 'vue';
import { useRouter } from 'vue-router';
import { useFile } from '@/composables/useFile';
import { useJobCategory } from '@/composables/useJobCategory';
import { fileToBlob, isValidaitonErrorsType } from '@/libs/utils';
import { validaitonErrorsType } from '@/libs/type';

export default defineComponent({
  setup() {
    const router = useRouter();

    const { upload } = useFile();
    const { createJobCategory } = useJobCategory();
    // フォームの状態
    const form = reactive({
      name: '',
      content: '',
      sortNo: 1,
      image: '',
      url: '',
    });
    // フォームのエラー内容
    const formErrors = reactive({
      name: '',
      content: '',
      sortNo: '',
      image: '',
      url: '',
    });

    // ファイルのアップロードを行います。
    const uploadFile = async (event: Event) => {
      const file = (event.currentTarget as HTMLInputElement).files?.item(0);
      if (file !== null && file !== undefined) {
        const blob = await fileToBlob(file);
        const response = await upload(blob);
        form.image = response.storagePath;
        form.url = response.url;
      }
    };

    // 「登録」押下時の処理
    const clickEntry = async () => {
      const response = await createJobCategory(
        form.name,
        form.content,
        form.image,
        form.sortNo
      );
      // 正常の場合
      if (!isValidaitonErrorsType(response)) {
        router.push({ name: 'JobCategoryMasterList' });
        return;
      }
      // バリデーションで弾かれた場合の場合
      formErrors.name = '';
      formErrors.content = '';
      formErrors.sortNo = '';
      formErrors.image = '';
      const errors = (response as validaitonErrorsType).errors;
      if ('name' in errors) {
        formErrors.name = errors['name'][0];
      }
      if ('content' in errors) {
        formErrors.content = errors['content'][0];
      }
      if ('image' in errors) {
        formErrors.image = errors['image'][0];
      }
      if ('sortNo' in errors) {
        formErrors.sortNo = errors['sortNo'][0];
      }
    };
    return { form, formErrors, uploadFile, clickEntry };
  },
});
</script>
