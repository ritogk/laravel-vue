<template>
  <div class="w-100">
    <h1 class="h2 mb-3">仕事マスタ(登録)</h1>
    <div class="card w-100 mx-auto">
      <div class="card-header">登録内容</div>
      <div class="card-body">
        <!-- 汎用エラーメッセージ -->
        <div class="mb-3">
          <div
            class="text-danger"
            v-text="formErrors.general"
            v-show="formErrors.general !== ''"
          />
        </div>

        <!-- 入力(職種) -->
        <div class="mb-3">
          <label for="inputJobCategoryId" class="form-label">職種</label>
          <select
            class="form-select"
            v-bind:class="[formErrors.jobCategoryId !== '' ? 'is-invalid' : '']"
            id="inputJobCategoryId"
            aria-describedby="inputJobCategoryIdFeedback"
            aria-label="Default select example"
            v-model="formInputs.jobCategoryId"
          >
            <option value=""></option>
            <option
              v-for="(name, index) in jobCategoryNms"
              :key="`jobCategory${index}`"
              v-bind:value="index"
              v-text="name"
            ></option>
          </select>
          <div
            id="inputJobCategoryIdFeedback"
            class="invalid-feedback"
            v-text="formErrors.jobCategoryId"
            v-show="formErrors.jobCategoryId !== ''"
          />
        </div>

        <!-- 入力(名称) -->
        <div class="mb-3">
          <label for="inputTitle" class="form-label">タイトル</label>
          <input
            type="text"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.title !== '' ? 'is-invalid' : '']"
            id="inputTitle"
            aria-describedby="inputTitleFeedback"
            v-model="formInputs.title"
            placeholder="タイトルを入力して下さい。"
          />
          <div
            id="inputTitleFeedback"
            class="invalid-feedback"
            v-text="formErrors.title"
            v-show="formErrors.title !== ''"
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
            v-model="formInputs.content"
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

        <!-- 入力(金額) -->
        <div class="mb-3">
          <label for="inputPrice" class="form-label">金額</label>
          <input
            type="number"
            class="form-control form-control-sm"
            v-bind:class="[formErrors.price !== '' ? 'is-invalid' : '']"
            id="inputPrice"
            aria-describedby="inputPriceFeedback"
            v-model="formInputs.price"
            placeholder="金額を入力して下さい。"
            required="required"
          />
          <div
            id="inputPriceFeedback"
            class="invalid-feedback"
            v-text="formErrors.price"
            v-show="formErrors.price !== ''"
          />
        </div>

        <!-- 入力(福利厚生) -->
        <div class="mb-3">
          <label for="inputWelfare" class="form-label">福利厚生</label>
          <textarea
            class="form-control form-control-sm"
            v-bind:class="[formErrors.welfare !== '' ? 'is-invalid' : '']"
            id="inputWelfare"
            aria-describedby="inputWelfareFeedback"
            v-model="formInputs.welfare"
            placeholder="福利厚生を入力して下さい。"
            rows="5"
          />
          <div
            id="inputWelfareFeedback"
            class="invalid-feedback"
            v-text="formErrors.welfare"
            v-show="formErrors.welfare !== ''"
          />
        </div>

        <!-- 入力(休日) -->
        <div class="mb-3">
          <label for="inputHoliday" class="form-label">休日</label>
          <textarea
            class="form-control form-control-sm"
            v-bind:class="[formErrors.holiday !== '' ? 'is-invalid' : '']"
            id="inputHoliday"
            aria-describedby="inputHolidayFeedback"
            v-model="formInputs.holiday"
            placeholder="休日を入力して下さい。"
            rows="5"
          />
          <div
            id="inputHolidayFeedback"
            class="invalid-feedback"
            v-text="formErrors.holiday"
            v-show="formErrors.holiday !== ''"
          />
        </div>

        <!-- 入力(注目させる) -->
        <div class="mb-3">
          <div class="form-check">
            <input
              class="form-check-input"
              v-bind:class="[formErrors.attention !== '' ? 'is-invalid' : '']"
              type="checkbox"
              value=""
              id="inputAttention"
              v-model="formInputs.attention"
            />
            <label class="form-check-label" for="inputAttention">
              注目させる
            </label>
          </div>
          <div
            id="inputAttention"
            class="invalid-feedback"
            v-text="formErrors.attention"
            v-show="formErrors.attention !== ''"
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
            v-model="formInputs.sortNo"
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
        <img
          :src="formInputs.url"
          class="img-fluid"
          alt="..."
          v-show="formInputs.url"
        />
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
import { useJob } from '@/composables/useJob';
import { fileToBlob } from '@/libs/utils';
import { isValidaitonErrorsType } from '@/libs/validation';

export default defineComponent({
  setup() {
    const route = useRoute();
    const router = useRouter();
    const { upload } = useFile();
    const { findJob, createJob, updateJob } = useJob();
    const jobCategory = useJobCategory();

    const jobCategoryNms = jobCategory.jobCategoryRefs.names;

    // 編集モードかどうかの判別フラグ
    const isEditMode = route.params.id !== undefined;
    // id
    const id = isEditMode ? Number(route.params.id) : 0;

    // フォームの状態
    const formRefs = reactive({
      // 入力値
      inputs: {
        title: '',
        content: '',
        jobCategoryId: '',
        attention: false,
        price: '',
        welfare: '',
        holiday: '',
        sortNo: '',
        image: '',
        url: '',
      },
      // エラー内容
      errors: {
        title: '',
        content: '',
        jobCategoryId: '',
        attention: '',
        price: '',
        welfare: '',
        holiday: '',
        sortNo: '',
        image: '',
        url: '',
        general: '',
      },
    });

    /**
     * 読み込み処理
     */
    const load = async () => {
      jobCategory.getJobCategories();
      // 編集モードの場合にマスタから値を取得する
      if (isEditMode) {
        const job = await findJob(id);
        formRefs.inputs.title = job.title;
        formRefs.inputs.content = job.content;
        formRefs.inputs.jobCategoryId = String(job.jobCategoryId);
        formRefs.inputs.attention = job.attention;
        formRefs.inputs.price = String(job.price);
        formRefs.inputs.welfare = job.welfare ?? '';
        formRefs.inputs.holiday = job.holiday ?? '';
        formRefs.inputs.image = job.image;
        formRefs.inputs.url = job.imageUrl;
        formRefs.inputs.sortNo = String(job.sortNo);
      }
    };
    load();

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
        response = await createJob(
          formRefs.inputs.title,
          formRefs.inputs.content,
          formRefs.inputs.attention,
          formRefs.inputs.jobCategoryId
            ? Number(formRefs.inputs.jobCategoryId)
            : null,
          formRefs.inputs.price ? Number(formRefs.inputs.price) : null,
          formRefs.inputs.image,
          formRefs.inputs.sortNo ? Number(formRefs.inputs.sortNo) : null,
          formRefs.inputs.welfare ?? undefined,
          formRefs.inputs.holiday ?? undefined
        );
      } else {
        // 編集の場合
        response = await updateJob(
          id,
          formRefs.inputs.title,
          formRefs.inputs.content,
          formRefs.inputs.attention,
          formRefs.inputs.jobCategoryId
            ? Number(formRefs.inputs.jobCategoryId)
            : null,
          formRefs.inputs.price ? Number(formRefs.inputs.price) : null,
          formRefs.inputs.image,
          formRefs.inputs.sortNo ? Number(formRefs.inputs.sortNo) : null,
          formRefs.inputs.welfare ?? undefined,
          formRefs.inputs.holiday ?? undefined
        );
      }
      // 正常の場合
      if (!isValidaitonErrorsType(response)) {
        router.push({ name: 'JobMasterList' });
        return;
      }

      // ■以降の処理はバリデーションで弾かれた場合
      // エラーメッセージの初期化を行う。
      Object.keys(formRefs.errors).forEach(function (key) {
        formRefs.errors[key as keyof typeof formRefs.errors] = '';
      });
      // サーバーサイドから受け取ったエラーメッセージをセット。
      const errors = response.errors;
      Object.keys(errors).forEach(function (key) {
        formRefs.errors[key as keyof typeof formRefs.errors] = errors[key][0];
      });
      // 汎用エラーメッセージをセット。
      if (Object.keys(errors).indexOf('message') !== -1) {
        formRefs.errors.general = errors['message'][0];
      }
      window.scroll({ top: 0, behavior: 'smooth' });
    };

    // 「戻る」押下時の処理
    const clickBack = () => {
      router.push({ name: 'JobMasterList' });
    };

    return {
      formInputs: formRefs.inputs,
      jobCategoryNms,
      formErrors: formRefs.errors,
      uploadFile,
      clickEntry,
      clickBack,
    };
  },
});
</script>
