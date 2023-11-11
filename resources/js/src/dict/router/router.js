import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";



const router = createRouter({
    linkActiveClass:"active-page",
    history:createWebHistory(),
    routes
})

router.beforeEach((to, from, next) =>{
    const accessToken = localStorage.getItem('access_token')

    if(!accessToken){
        if (to.name === 'login' || to.name === 'signup') {
            return next()
        } else {
            return next({
                name:"login"
            })
        }
    }


    next()
})
export default router
