import Home from "../pages/Home.vue";
import ProfilePage from "../pages/ProfilePage.vue";
import TagsPage from "../pages/TagsPage.vue";
import TaskPage from "../pages/TaskPage.vue";
import NotFoundPage from "../pages/NotFoundPage.vue";
import TestPage from "../pages/TestPage.vue";


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
        path: "/404",
        name: "NotFoundPage",
    },
    {
        redirect: {name: "NotFoundPage"},
        path: "/:catchAll(.*)"
    },
    {
        component: TestPage,
        path: '/test'
    }
]

export default routes
