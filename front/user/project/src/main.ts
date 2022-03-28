import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import 'bootstrap';
import './assets/boootstrapCustom.scss';

const app = createApp(App);
app.use(router);
app.mount('#app');

// import { Amplify, I18n } from 'aws-amplify';
// import { config, i18Dict } from '@/libs/amplify';
// import { translations } from '@aws-amplify/ui-vue';
// Amplify.configure(config);
// // 言語周りの設定
// I18n.setLanguage('ja');
// I18n.putVocabularies(translations);
// I18n.putVocabularies(i18Dict);
