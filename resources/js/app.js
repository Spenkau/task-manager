import {createApp} from "vue"
import App from "./src/App.vue"
import router from "./src/router/router";
import {VueQueryPlugin} from 'vue-query'

const app = createApp(App)

app
    .use(router)
    .use(VueQueryPlugin)
    .mount('#app')
