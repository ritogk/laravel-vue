<template>
  <div class="d-flex flex-row">
    <SearchBox />
    <ListBox />
  </div>
</template>

<script lang="ts">
import SearchBox from '@/components/JobEntry/SearchBox.vue';
import ListBox from '@/components/JobEntry/ListBox.vue';
import { defineComponent } from 'vue';

export default defineComponent({
  components: {
    SearchBox,
    ListBox,
  },
  setup() {
    return {};
  },
});
</script>
