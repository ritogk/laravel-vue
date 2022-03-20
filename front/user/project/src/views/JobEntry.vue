<template>
  <div class="d-flex flex-row">
    <SearchBox :jobCategoryId="queryJobCategoryId" />
    <ListBox />
  </div>
</template>

<script lang="ts">
import { defineComponent, provide } from 'vue';
import { useRoute, LocationQueryValue } from 'vue-router';
import SearchBox from '@/components/JobEntry/SearchBox.vue';
import ListBox from '@/components/JobEntry/ListBox.vue';
import { useJob, jobKey } from '@/composables/useJob';

export default defineComponent({
  components: {
    SearchBox,
    ListBox,
  },
  setup() {
    const job = useJob();
    provide(jobKey, job);

    // クエリパラメーター(職種id)を取得
    const route = useRoute();
    const queryJobCategoryId = (route.query.jobCategoryId as LocationQueryValue)
      ? Number(route.query.jobCategoryId)
      : undefined;

    return { queryJobCategoryId };
  },
});
</script>
