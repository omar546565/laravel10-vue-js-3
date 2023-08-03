import './bootstrap';
import './plugins/axios';
import router from './router';
import { createApp } from 'vue';
import Home from './layouts/Home.vue';

const app = createApp({});

app.component('home-component', Home);
app.use(router);
app.mount('#app');
