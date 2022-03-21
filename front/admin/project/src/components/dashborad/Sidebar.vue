<style scoped>
.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100;
  padding: 48px 0 0;
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 5rem;
  }
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto;
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #727272;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: 0.95rem;
  text-transform: uppercase;
}
</style>

<template>
  <nav
    id="sidebarMenu"
    class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
  >
    <div class="position-sticky pt-1">
      <h6
        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"
      >
        <span>メイン</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a
            class="nav-link"
            href="#"
            v-bind:class="{ active: isActiveMenuNo(3) }"
            @mouseover="setActiveMenuNo(3)"
            @click="clickConsideration"
          >
            <vue-feather type="file"></vue-feather>
            選考一覧
          </a>
        </li>
      </ul>
      <h6
        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"
      >
        <span>マスタ</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a
            class="nav-link"
            v-bind:class="{ active: isActiveMenuNo(2) }"
            @mouseover="setActiveMenuNo(2)"
            aria-current="page"
            href="#"
            @click="clickJob"
          >
            <vue-feather type="home"></vue-feather>
            仕事マスタ
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            v-bind:class="{ active: isActiveMenuNo(1) }"
            @mouseover="setActiveMenuNo(1)"
            href="#"
            @click="clickJobCategory"
          >
            <vue-feather type="file"></vue-feather>
            職種マスタ
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
  setup() {
    const router = useRouter();

    // アクティブなメニューNo
    const activeMenuNo = ref(0);
    // 指定のメニューNoがアクティブかどうかを判定します。
    const isActiveMenuNo = (index: number): boolean => {
      return activeMenuNo.value === index;
    };
    // アクティブなメニューNoを設定します。
    const setActiveMenuNo = (index: number) => {
      activeMenuNo.value = index;
    };

    // 「選考一覧」押下時の処理
    const clickConsideration = () => {
      router.push({ name: 'ConsiderationList' });
    };

    // 「職種マスタ」押下時の処理
    const clickJobCategory = () => {
      router.push({ name: 'JobCategoryMasterList' });
    };

    // 「仕事マスタ」押下時の処理
    const clickJob = () => {
      router.push({ name: 'JobMasterList' });
    };

    return {
      clickConsideration,
      clickJobCategory,
      clickJob,
      isActiveMenuNo,
      setActiveMenuNo,
    };
  },
});
</script>
