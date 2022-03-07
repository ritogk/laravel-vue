<template>
  <MainHeader />
  <div class="container py-4">
    <router-view />
  </div>
  <MainFooter />
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import MainHeader from '@/components/MainHeader.vue';
import MainFooter from '@/components/MainFooter.vue';

export default defineComponent({
  components: {
    MainHeader,
    MainFooter,
  },
  setup() {
    // const categories = ref<JobCategory[]>([]);
    // const loading = ref(true);

    // const jobCategoryApi = new JobCategorieApi();

    // const load = async () => {
    //   const response = await jobCategoryApi.jobCategoriesGet({});
    //   categories.value = response;
    //   loading.value = false;
    // };
    // load();

    return {};
  },
});
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
