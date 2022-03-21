<template>
  <div class="card text-white">
    <img
      :src="imageUrl"
      class="card-img category-card"
      style="max-width: 20rem; height: 200px; filter: brightness(0.65)"
    />
    <div class="card-img-overlay">
      <h4 class="card-title" v-text="title"></h4>
      <p class="card-text">
        <span v-text="text"></span>
        <a href="#" class="stretched-link"></a>
      </p>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    imageUrl: String,
    title: String,
    text: String,
  },
  setup() {
    return {};
  },
});
</script>
