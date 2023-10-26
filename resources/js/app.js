import {createApp} from "vue";
import App from "./src/App.vue";
import router from "./src/router/router";
import {VueQueryPlugin} from 'vue-query';
import './bootstrap.js';
import axios from "axios";

const app = createApp(App)

app.use(router)
   .use(VueQueryPlugin)
   .mount('#app')

document.querySelector('#submit-button').addEventListener(
    'click',
    () => axios.post('/button/clicked')
);

Echo.channel('public-channel')
    // Listen for the event called "button.clicked"
    .listen('ButtonClickedController', (e) => {

        // Display the "message" in an alert box
        alert('faf')
    });
