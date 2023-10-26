import Home from "../pages/Home.vue";
import ProfilePage from "../pages/ProfilePage.vue";
import TagsPage from "../pages/TagsPage.vue";
import TaskPage from "../pages/TaskPage.vue";

const routes = [
    {
        component:Home,
        path:'/main'
    },
    {
        component:TagsPage,
        path:'/tags'
    },
    {
        component:ProfilePage,
        path:'/profile'
    },
    {
        component:TaskPage,
        path:'/task/:id'
    }
]

export default routes
