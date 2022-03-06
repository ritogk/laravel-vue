import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

const app = createApp(App);
app.use(router);
app.mount('#app');
