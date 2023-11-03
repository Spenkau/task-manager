import {createApp} from "vue";
import App from "./src/App.vue";
import router from "./src/dict/router/router";
import {VueQueryPlugin} from "vue-query";
import "./bootstrap.js";
import "./src/dict/vuetify/vuetify"
import "./src/dict/axios/api"
import vuetify from "./src/dict/vuetify/vuetify";
import {createPinia} from "pinia";


const pinia = createPinia()
const app = createApp(App)

app
    .use(router)
    .use(pinia)
    .use(vuetify)
    .use(VueQueryPlugin)
    .mount('#app')


