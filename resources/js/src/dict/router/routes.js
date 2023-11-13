import Home from "../../pages/Home.vue";
import ProfilePage from "../../pages/ProfilePage.vue";
import TagsPage from "../../pages/TagsPage.vue";
import TaskPage from "../../pages/TaskPage.vue";
import NotFoundPage from "../../pages/NotFoundPage.vue";
import TestPage from "../../pages/TestPage.vue";
import SignUpPage from "../../pages/User/SignUpPage.vue";
import LoginPage from "../../pages/User/LoginPage.vue";
import ArchivePage from "../../pages/ArchivePage.vue"

const routes = [
    {
        component: Home,
        path: '/',
        name: 'home'
    },
    {
        component: TagsPage,
        path: '/user/:username/tags'
    },
    {
        component: TaskPage,
        path: '/user/:username/task/:id'
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
        component: ProfilePage,
        path: '/user/:username'
    },
    {
        component: TestPage,
        path: '/test'
    },
    {
        component: SignUpPage,
        path: '/signup',
        name: 'signup'
    },
    {
        component: LoginPage,
        path: '/login',
        name: 'login'
    },
    {
        component: ArchivePage,
        path: '/user/:username/archive'
    }
]

export default routes
