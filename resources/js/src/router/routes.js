import Home from "../pages/Home.vue";
import ProfilePage from "../pages/ProfilePage.vue";
import TagsPage from "../pages/TagsPage.vue";
import TaskPage from "../pages/TaskPage.vue";
import NotFoundPage from "../pages/NotFoundPage.vue";

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
        path: '/profile'
    },
    {
        component: TaskPage,
        path: '/task/:id'
    },
    {
        component: NotFoundPage,
        path: "/:catchAll(.*)"
    }
]

export default routes
