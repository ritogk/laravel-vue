<template>
  <div class="w-100">
    <h1 class="h2 mb-3">職種マスタ</h1>
    <div class="card">
      <div class="card-header">検索条件</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">名称</label>
            <input type="email" class="form-control" id="inputEmail4" />
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
        <button class="btn btn-primary text-white me-2">検索</button>
        <button class="btn btn-primary text-white me-2">新規作成</button>
        <button class="btn btn-primary text-white me-2">マスタ出力</button>
      </div>
    </div>

    <div class="card mt-3">
      <DataTable
        :value="customers"
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
        :globalFilterFields="['name', 'balance']"
        responsiveLayout="scroll"
      >
        <template #header>
          <div class="d-flex justify-content-between">
            <div />
            <span class="p-input-icon-left">
              <i class="pi pi-search" />
              <InputText
                v-model="filters['global'].value"
                placeholder="Keyword Search"
              />
            </span>
          </div>
        </template>
        <template #empty> No customers found. </template>
        <template #loading> Loading customers data. Please wait. </template>
        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
        <Column field="name" header="名称" sortable style="min-width: 14rem">
          <template #body="{ data }">
            {{ data.name }}
          </template>
          <template #filter="{ filterModel }">
            <InputText
              type="text"
              v-model="filterModel.value"
              class="p-column-filter"
              placeholder="Search by name"
            />
          </template>
        </Column>
        <Column
          field="balance"
          header="内容"
          sortable
          dataType="numeric"
          style="min-width: 8rem"
        >
          <template #body="{ data }">
            {{ data.balance }}
          </template>
          <template #filter="{ filterModel }">
            <InputNumber
              v-model="filterModel.value"
              mode="currency"
              currency="USD"
              locale="en-US"
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
            {{ data.balance }}
          </template>
        </Column>
        <Column
          field="action"
          header="操作"
          sortable
          dataType="numeric"
          style="min-width: 8rem"
        >
          <template #body="{ data }">
            <button class="btn btn-success text-white me-2">編集</button>
            <button class="btn btn-danger text-white">削除</button>
            <span v-text="data.balance" hidden></span>
          </template>
        </Column>
      </DataTable>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import { FilterMatchMode, FilterOperator } from 'primevue/api';

export default defineComponent({
  setup() {
    onMounted(() => {
      customers.value = [
        {
          id: 1000,
          name: 'James Butt',
          country: {
            name: 'Algeria',
            code: 'dz',
          },
          company: 'Benton, John B Jr',
          date: '2015-09-13',
          status: 'unqualified',
          verified: true,
          activity: 17,
          representative: {
            name: 'Ioni Bowcher',
            image: 'ionibowcher.png',
          },
          balance: 70663,
        },
        {
          id: 1001,
          name: 'Josephine Darakjy',
          country: {
            name: 'Egypt',
            code: 'eg',
          },
          company: 'Chanay, Jeffrey A Esq',
          date: '2019-02-09',
          status: 'proposal',
          verified: true,
          activity: 0,
          representative: {
            name: 'Amy Elsner',
            image: 'amyelsner.png',
          },
          balance: 82429,
        },
      ];
      loading.value = false;
    });
    const customers = ref();
    const filters = ref({
      global: { value: null, matchMode: FilterMatchMode.CONTAINS },
      name: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }],
      },
      balance: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],
      },
    });
    const loading = ref(true);
    return {
      customers,
      filters,
      loading,
    };
  },
});
</script>
