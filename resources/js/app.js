require('./bootstrap');

import "bootstrap";
import { createApp } from 'vue'
import LinkCreate from './components/LinkCreate.vue'
import Stats from './components/Stats.vue'
import Loader from './components/Loader.vue';

const app = createApp({})

app.component('link-create', LinkCreate)
app.component('stats', Stats)
app.component('loader', Loader)

app.mount('#app')
