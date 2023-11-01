import {createApp} from "vue";
import App from "./src/App.vue";
import router from "./src/dict/router/router";
import {VueQueryPlugin} from "vue-query";
import "./bootstrap.js";
import "./src/dict/vuetify/vuetify"
import "./src/dict/axios/axios"
import vuetify from "./src/dict/vuetify/vuetify";
import auth from "./src/dict/auth/auth";



const app = createApp(App)

app
    .use(router)
    .use(auth)
    .use(vuetify)
    .use(VueQueryPlugin)
    .mount('#app')


