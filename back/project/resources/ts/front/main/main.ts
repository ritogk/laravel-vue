import "core-js/stable";
import "regenerator-runtime/runtime";

import axios, { AxiosStatic } from 'axios';
import Vue from 'vue';
import VueRouter from "vue-router";
import router from './router';

declare global {
    interface Window {
      axios:  AxiosStatic;
      format: any;
    }
    interface Element {
      content: string;
    }
}

// axios 初期設定
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

require('bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);

// bootstrapvueの初期値設定
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
Vue.use(BootstrapVue, {
    BButton: {
        size: 'sm',
    },
    BFormSelect: {
        size: 'sm',
    },
    BFormInput: {
        placeholder: '',
        size: 'sm',
        autocomplete: "off",
    },
    BFormGroup: {
        labelSize: 'sm',
        labelAlignSm: 'left',
        labelColsSm: "2",
    },
    BInputGroup: {
        size: 'sm',
    },
    BTable: {
        stacked: 'md',
        hover: true ,
        showEmpty: true,
        small: true,
        striped: true,
    },
    BPagination: {
        align: 'fill',
        size: 'sm',
        class: 'my-0'
    },
})
Vue.use(IconsPlugin);

// jsで文字列フォーマットを使うライブラリ
window.format = require('sprintf-js');

// vueにグローバル定数セット
import gv2 from '@root/mixins/form_validation';
Vue.mixin(gv2);

// 入力値の復元
import { state as statejobCond} from "@front/main/state/job_cond";
statejobCond.restore()

// ログイン会員情報取得
import { state as stateUser} from "@front/main/state/user";
window.axios.get('/api/auth/front/user').then(function(response){
    stateUser.setLoginUser({
        user: response.data,
        status:true
    })
}).catch(error =>{});

import component from './components/App.vue';
new Vue({
    el: '#app',
    router: router,
    render: h => h(component),
});
