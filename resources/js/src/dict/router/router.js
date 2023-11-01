import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";


const router = createRouter({
    linkActiveClass:"active-page",
    history:createWebHistory(),
    routes
})

export default router
