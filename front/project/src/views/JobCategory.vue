<style scoped>
img {
}
</style>

<template>
  <div class="p-4">
    <div class="card border-primary mb-3">
      <div class="card-header bg-primary text-white">職種</div>
      <div class="card-body">
        <h6 class="card-subtitle mb-2 text-muted">
          ご希望の職種を選択して下さい。
        </h6>
        <div class="d-flex flex-wrap">
          <div
            v-for="(category, index) in categories"
            :key="`category-${index}`"
            :category="category"
            v-show="!loading"
          >
            <div class="card text-white">
              <img
                :src="`http://localhost${category.imageUrl}`"
                class="card-img category-card"
                style="
                  max-width: 20rem;
                  height: 200px;
                  filter: brightness(0.65);
                "
              />
              <div class="card-img-overlay">
                <h4 class="card-title" v-text="category.name"></h4>
                <p class="card-text">
                  <span v-text="category.content"></span>
                  <a
                    href="#"
                    @click.prevent="pageTransition(category)"
                    class="stretched-link"
                  ></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {
  computed,
  defineComponent,
  reactive,
  watchEffect,
  onMounted,
  ref,
} from 'vue';
import { JobCategorieApi } from '@/open_api/apis/JobCategorieApi';
import { JobCategory } from '@/open_api';

export default defineComponent({
  setup() {
    const categories = ref<JobCategory[]>([]);
    const loading = ref(true);

    const jobCategoryApi = new JobCategorieApi();

    const load = async () => {
      const response = await jobCategoryApi.jobCategoriesGet({});
      categories.value = response;
      loading.value = false;
    };
    load();

    return { categories, loading };
  },
});
</script>
