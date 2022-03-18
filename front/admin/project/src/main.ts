import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import 'bootstrap';
import './assets/boootstrapCustom.scss';

const app = createApp(App);
app.use(router);
app.mount('#app');

// ダッシュボードのサイドメニュー内のアイコンで使用
import VueFeather from 'vue-feather';
app.component(VueFeather.name, VueFeather);

// データテーブルで使用
import './assets/primeVueCustom.scss';
import PrimeVue from 'primevue/config';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import InputText from 'primevue/inputtext';
app.use(PrimeVue);
app.component('DataTable', DataTable);
app.component('Column', Column);
app.component('ColumnGroup', ColumnGroup);
app.component('InputText', InputText);
