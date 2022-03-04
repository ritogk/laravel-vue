<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" />
    <HelloWorld msg="Welcome to Your Vue.js + TypeScript App" />
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';
import HelloWorld from '@/components/HelloWorld.vue';
import AboutView from '@/views/AboutView.vue';
import { JobApi } from '@/open_api';

const test = new JobApi();
test.jobsGet({});
@Options({
  components: {
    HelloWorld,
  },
})
export default class HomeView extends Vue {}
</script>
