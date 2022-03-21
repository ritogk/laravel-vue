<template>
  <div class="w-100">
    <h1 class="h2 mb-3">仕事マスタ</h1>
    <div class="card">
      <div class="card-header">検索条件</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="inputName" class="form-label">タイトル</label>
            <input
              type="text"
              class="form-control"
              id="inputName"
              v-model="condition.title"
            />
          </div>
          <div class="col-md-6">
            <label for="inputContent" class="form-label">カテゴリ</label>
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
        </div>
      </div>
      <div class="card-footer text-muted">
        <div class="d-flex">
          <div>
            <button
              class="btn btn-primary text-white me-2"
              @click="clickSearch"
            >
              検索
            </button>
          </div>
          <div>
            <button class="btn btn-primary text-white" @click="clickCreate">
              新規作成
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <DataTable
        :value="jobs"
        :paginator="true"
        class="p-datatable-customers"
        stripedRows
        :rows="10"
        dataKey="id"
        :rowHover="true"
        v-model:filters="filters"
        filterDisplay="menu"
        :loading="loading"
        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
        :rowsPerPageOptions="[10, 25, 50]"
        currentPageReportTemplate="{totalRecords} 件中 {first} から {last} まで表示"
        :globalFilterFields="[
          'title',
          'content',
          'jobCategory',
          'price',
          'sortNo',
        ]"
        responsiveLayout="scroll"
      >
        <template #header>
          <div class="d-flex justify-content-between">
            <div />
            <span class="p-input-icon-left">
              <i class="pi pi-search" />
              <InputText
                v-model="filters['global'].value"
                placeholder="キーワードを入力して下さい。"
              />
            </span>
          </div>
        </template>
        <template #empty> データが存在しません。 </template>
        <template #loading> Loading data. Please wait. </template>
        <Column
          field="name"
          header="タイトル"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ data.title }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by タイトル"
            />
          </template>
        </Column>

        <Column field="content" header="内容" sortable style="min-width: 14rem">
          <template #body="{ data }">
            <div class="cut-text">
              {{ data.content }}
            </div>
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 内容"
            />
          </template>
        </Column>

        <Column
          field="jobCategory"
          header="職種"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ jobCategoryNms[data.jobCategoryId] }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 職種"
            />
          </template>
        </Column>

        <Column field="price" header="金額" sortable style="min-width: 14rem">
          <template #body="{ data }">
            {{ convertComma(data.price) }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 金額"
            />
          </template>
        </Column>

        <Column
          field="sortNo"
          header="並び順"
          sortable
          dataType="numeric"
          style="min-width: 8rem"
        >
          <template #body="{ data }">
            {{ data.sortNo }}
          </template>
        </Column>

        <Column
          field="action"
          header="操作"
          dataType="text"
          style="min-width: 8rem"
        >
          <template #body="{ data }">
            <button
              class="btn btn-success text-white me-2"
              @click="clickEdit(data.id)"
            >
              編集
            </button>
            <button
              class="btn btn-danger text-white"
              @click="clickDelete(data.id)"
            >
              削除
            </button>
            <span v-text="data.sortNo" hidden></span>
          </template>
        </Column>
      </DataTable>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import { useJob } from '@/composables/useJob';
import { useJobCategory } from '@/composables/useJobCategory';
import { convertComma } from '@/libs/utils';

export default defineComponent({
  setup() {
    const router = useRouter();

    const job = useJob();
    const jobs = job.jobRefs.items;

    const jobCategory = useJobCategory();
    const jobCategoryNms = jobCategory.jobCategoryRefs.names;

    // ローディングを判別するフラグ
    const loading = ref(true);

    // 検索条件
    const condition = reactive({
      title: '',
      jobCategoryId: '',
    });

    const load = async () => {
      await job.getJobs();
      await jobCategory.getJobCategories();
      loading.value = false;
    };
    load();

    // データテーブル内の絞り込み設定
    const filters = ref({
      // 全体
      global: { value: null, matchMode: FilterMatchMode.CONTAINS },
      // タイトル
      title: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 内容
      content: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 職種
      jobCategory: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 金額
      price: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
    });

    // 「検索」押下時の処理
    const clickSearch = () => {
      job.getJobs(
        condition.title ? condition.title : undefined,
        condition.jobCategoryId ? Number(condition.jobCategoryId) : undefined
      );
    };

    // 「新規作成」押下時の処理
    const clickCreate = () => {
      router.push({ name: 'JobMasterCreate' });
    };

    // 「編集」押下時の処理
    const clickEdit = (id: number) => {
      router.push({
        name: 'JobMasterEdit',
        params: { id: id },
      });
    };

    // 「削除」押下時の処理
    const clickDelete = async (id: number) => {
      const name = jobs.value.find((v) => v.id === id)?.title;
      if (window.confirm(`「${name}」を削除します。\nよろしいですか？`)) {
        await job.deleteJob(id);
        clickSearch();
      }
    };

    return {
      jobCategoryNms,
      jobs,
      loading,
      condition,
      filters,
      convertComma,
      clickCreate,
      clickEdit,
      clickSearch,
      clickDelete,
    };
  },
});
</script>
