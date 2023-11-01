import {createAuth} from "@websanova/vue-auth";
import axios from "axios";
import driverAuthBearer      from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios       from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
import driverOAuth2Google    from '@websanova/vue-auth/dist/drivers/oauth2/google.esm.js';
import driverOAuth2Facebook  from '@websanova/vue-auth/dist/drivers/oauth2/facebook.esm.js';
import router from "../router/router";



const auth = createAuth({
    plugins: {
        http: axios,
        router
    },
    drivers: {
        http: driverHttpAxios,
        auth: driverAuthBearer,
        router: driverRouterVueRouter,

    },
    options: {
        rolesKey: 'type',
        notFoundRedirect: {name: 'user-account'},
    }
})

export default auth
