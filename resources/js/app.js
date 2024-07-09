import { createApp } from "vue";
import App from './components/App.vue';
import router from './components/router';
import vuetify from './components/plugins/vuetify';

import 'vuetify/dist/vuetify.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

createApp(App)
    .use(router)
    .use(vuetify)
    .mount('#app');

