<template>
  <div class="w-100">
    <h1 class="h2 mb-3">職種マスタ(編集)</h1>
    <div class="card w-100 mx-auto">
      <div class="card-header">ログイン</div>
      <div class="card-body">
        <!-- 汎用エラーメッセージ -->
        <div class="mb-3">
          <div
            class="text-danger"
            v-text="formErrors.general"
            v-show="formErrors.general !== ''"
          />
        </div>
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
        <button
          type="button"
          class="btn btn-secondary text-light"
          @click="clickBack"
        >
          戻る
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from 'vue';
import { useRoute } from 'vue-router';
import { useRouter } from 'vue-router';
import { useFile } from '@/composables/useFile';
import { useJobCategory } from '@/composables/useJobCategory';
import { fileToBlob, isValidaitonErrorsType } from '@/libs/utils';

export default defineComponent({
  setup() {
    const route = useRoute();
    const router = useRouter();
    const { upload } = useFile();
    const { findJobCategory, createJobCategory, updateJobCategory } =
      useJobCategory();

    // 編集モードかどうかの判別フラグ
    const isEditMode = route.params.id !== undefined;
    // 職種id
    const id = isEditMode ? Number(route.params.id) : 0;
    const load = async () => {
      // 編集モードの場合にマスタから値を取得する
      if (isEditMode) {
        const jobCategory = await findJobCategory(id);
        formRefs.inputs.name = jobCategory.name;
        formRefs.inputs.content = jobCategory.content;
        formRefs.inputs.image = jobCategory.image;
        formRefs.inputs.url = jobCategory.imageUrl;
        formRefs.inputs.sortNo = jobCategory.sortNo;
      }
    };
    load();

    // フォームの状態
    const formRefs = reactive({
      // 入力値
      inputs: {
        name: '',
        content: '',
        sortNo: 1,
        image: '',
        url: '',
      },
      // エラー内容
      errors: {
        name: '',
        content: '',
        sortNo: '',
        image: '',
        url: '',
        general: '',
      },
    });

    // ファイル選択後にサーバーへアップロードを行う。
    const uploadFile = async (event: Event) => {
      const file = (event.currentTarget as HTMLInputElement).files?.item(0);
      if (file !== null && file !== undefined) {
        const blob = await fileToBlob(file);
        const response = await upload(blob);
        formRefs.inputs.image = response.storagePath;
        formRefs.inputs.url = response.url;
      }
    };

    // 「登録」押下時の処理
    const clickEntry = async () => {
      let response;
      if (!isEditMode) {
        // 新規登録の場合
        response = await createJobCategory(
          formRefs.inputs.name,
          formRefs.inputs.content,
          formRefs.inputs.image,
          formRefs.inputs.sortNo
        );
      } else {
        // 編集の場合
        response = await updateJobCategory(
          id,
          formRefs.inputs.name,
          formRefs.inputs.content,
          formRefs.inputs.image,
          formRefs.inputs.sortNo
        );
      }
      // 正常の場合
      if (!isValidaitonErrorsType(response)) {
        router.push({ name: 'JobCategoryMasterList' });
        return;
      }

      // ■バリデーションで弾かれた場合の場合
      // エラーメッセージの初期化を行う。
      Object.keys(formRefs.errors).forEach(function (key) {
        formRefs.errors[key as keyof typeof formRefs.errors] = '';
      });
      // エラーメッセージをセット。
      const errors = response.errors;
      Object.keys(errors).forEach(function (key) {
        if (Object.keys(errors).indexOf(key) !== -1) {
          formRefs.errors[key as keyof typeof formRefs.errors] = errors[key][0];
        }
      });
      // 汎用エラーメッセージをセット。
      if (Object.keys(errors).indexOf('message') !== -1) {
        formRefs.errors.general = errors['message'][0];
      }
      window.scroll({ top: 0, behavior: 'smooth' });
    };

    // 「戻る」押下時の処理
    const clickBack = () => {
      router.push({ name: 'JobCategoryMasterList' });
    };

    return {
      form: formRefs.inputs,
      formErrors: formRefs.errors,
      uploadFile,
      clickEntry,
      clickBack,
    };
  },
});
</script>
