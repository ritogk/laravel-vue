<template>
  <div class="w-100">
    <h1 class="h2 mb-3">選考一覧</h1>
    <div class="card">
      <div class="card-header">検索条件</div>
      <div class="card-body">
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label for="inputJobCategory" class="form-label">職種</label>
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
        <div class="row g-3">
          <div class="col-md-6">
            <label for="inputName" class="form-label">氏名</label>
            <input
              type="text"
              class="form-control"
              id="inputName"
              v-model="condition.userName"
            />
          </div>
          <div class="col-md-6">
            <label for="inputSelfPr" class="form-label">自己PR</label>
            <input
              type="text"
              class="form-control"
              id="inputSelfPr"
              v-model="condition.selfPr"
            />
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
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <DataTable
        :value="jobEntries"
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
          'job.title',
          'job.jobCategory.name',
          'user.name',
          'user.email',
          'user.tel',
          'user.selfPr',
          'entryDate',
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
          field="job.title"
          header="求人名"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ data.job.title }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 求人名"
            />
          </template>
        </Column>

        <Column
          field="job.jobCategory.name"
          header="職種"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ data.job.jobCategory.name }}
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

        <Column
          field="user.name"
          header="氏名"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ data.user.name }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 氏名"
            />
          </template>
        </Column>

        <Column
          field="user.email"
          header="メールアドレス"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ data.user.email }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by メールアドレス"
            />
          </template>
        </Column>

        <Column
          field="user.tel"
          header="電話番号"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ data.user.tel }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 電話番号"
            />
          </template>
        </Column>

        <Column
          field="user.selfPr"
          header="自己PR"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ data.user.selfPr }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 自己PR"
            />
          </template>
        </Column>

        <Column
          field="entryDate"
          header="応募日"
          sortable
          style="min-width: 14rem"
        >
          <template #body="{ data }">
            {{ moment(data.entryDate).format('YYYY/MM/DD') }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by 応募日"
            />
          </template>
        </Column>
      </DataTable>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, reactive } from 'vue';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import { useJobEntry } from '@/composables/useJobEntry';
import { useJobCategory } from '@/composables/useJobCategory';
import moment from 'moment';

export default defineComponent({
  setup() {
    const jobEntry = useJobEntry();
    const jobEntries = jobEntry.jobEntryRefs.items;

    const jobCategory = useJobCategory();
    const jobCategoryNms = jobCategory.jobCategoryRefs.names;

    // ローディングを判別するフラグ
    const loading = ref(true);

    // 検索条件
    const condition = reactive({
      jobCategoryId: '',
      userName: '',
      selfPr: '',
    });

    // 読み込み
    const load = async () => {
      await jobEntry.getJobEntries();
      await jobCategory.getJobCategories();
      loading.value = false;
    };
    load();

    // データテーブル内の絞り込み設定
    const filters = ref({
      // 全体
      global: { value: null, matchMode: FilterMatchMode.CONTAINS },
      // 求人名
      'job.title': {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 職種
      'job.jobCategory.name': {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 氏名
      'user.name': {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // メールアドレス
      'user.email': {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 電話番号
      'user.tel': {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 自己PR
      'user.selfPr': {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      // 応募日
      entryDate: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
    });

    // 「検索」押下時の処理
    const clickSearch = () => {
      jobEntry.getJobEntries(
        undefined,
        condition.jobCategoryId ? Number(condition.jobCategoryId) : undefined,
        condition.userName ? condition.userName : undefined,
        condition.selfPr ? condition.selfPr : undefined
      );
    };

    return {
      jobCategoryNms,
      jobEntries,
      loading,
      condition,
      filters,
      clickSearch,
      moment,
    };
  },
});
</script>
