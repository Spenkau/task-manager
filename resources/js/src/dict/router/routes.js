import Home from "../../pages/Home.vue";
import ProfilePage from "../../pages/ProfilePage.vue";
import TagsPage from "../../pages/TagsPage.vue";
import TaskPage from "../../pages/TaskPage.vue";
import NotFoundPage from "../../pages/NotFoundPage.vue";
import TestPage from "../../pages/TestPage.vue";
import UserPage from "../../pages/UserPage.vue";
import SignUpPage from "../../pages/User/SignUpPage.vue";
import LoginPage from "../../pages/User/LoginPage.vue";


const routes = [
    {
        component: Home,
        path: '/main'
    },
    {
        component: TagsPage,
        path: '/tags'
    },
    {
        component: ProfilePage,
        path: '/user'
    },
    {
        component: TaskPage,
        path: '/task/:id'
    },
    {
        component: NotFoundPage,
        path: '/404',
        name: 'NotFoundPage',
    },
    {
        redirect: {name: 'NotFoundPage'},
        path: '/:catchAll(.*)'
    },
    {
        component: UserPage,
        path: '/user/:username'
    },
    {
        component: TestPage,
        path: '/test'
    },
    {
        component: SignUpPage,
        path: '/signup'
    },
    {
        component: LoginPage,
        path: '/login'
    }
]

export default routes
