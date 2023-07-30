import './bootstrap';
import router from './router';
import { createApp } from 'vue';
import Home from './pages/Home.vue';

const app = createApp({});

app.component('home-component', Home);
app.use(router);
app.mount('#app');
