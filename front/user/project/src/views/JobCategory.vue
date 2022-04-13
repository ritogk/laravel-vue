<template>
  <div class="card border-primary mb-3">
    <div class="card-header bg-primary text-white">職種</div>
    <div class="card-body">
      <h6 class="card-subtitle mb-2 text-muted">
        ご希望の職種を選択して下さい。(ci_test)
      </h6>
      <div class="d-flex flex-wrap mb-3">
        <VueElementLoading :active="loading" spinner="ring" size="50" />
        <div
          v-for="(category, index) in categories"
          :key="`category-${index}`"
          :category="category"
          v-show="!loading"
          class="m-2"
        >
          <div @click.prevent="clickCategory(category.id)">
            <TextOnImage
              :imageUrl="category.imageUrl"
              :title="category.name"
              :text="category.content"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';
import TextOnImage from '@/components/TextOnImage.vue';
import VueElementLoading from 'vue-element-loading';
import { useJobCategory } from '@/composables/useJobCategory';

export default defineComponent({
  components: {
    VueElementLoading,
    TextOnImage,
  },
  setup() {
    const router = useRouter();
    const jobCategory = useJobCategory();
    const loading = ref(true);
    const categories = jobCategory.jobCategoryRefs.items;

    // 読み込み
    const load = async () => {
      await jobCategory.getJobCategory();
      loading.value = false;
    };
    load();

    // 「職種」押下時の処理
    const clickCategory = (categoryId: string) => {
      router.push({
        name: 'JobEntry',
        query: { jobCategoryId: categoryId },
      });
    };

    return { categories, loading, clickCategory };
  },
});
</script>
