<template>
    <TheHeader>
        <i class="icon-sidebar-open" @mousemove="showSidebar = true"> открыть сайдбар </i>
    </TheHeader>
    <template v-if="isAuth">
        <div class="body-main">
            <div class="left" @mousemove="showSidebar=true"></div>
            <Sidebar v-if="showSidebar" @mouseleave="showSidebar=false">
                <CategoryList :categories="categories.value"/>
            </Sidebar>
            <section class="main">
                <div class="active-task">
                    <h2 class="list-header">Активные задачи</h2>
                    <Suspense>
                        <TaskList/>
                        <template #fallback>
                            <p>
                                ожидание
                            </p>
                        </template>
                    </Suspense>
                </div>
                <v-container>
                    <DateTimePanel/>
                    <UserObservation/>
                </v-container>
            </section>
        </div>
    </template>
    <template v-else>
        <UserNotAuth/>
    </template>
</template>

<script>
import TheHeader from "../components/header/TheHeader.vue";
import Sidebar from "../components/sidebar/Sidebar.vue";
import DateTimePanel from "../components/widgets/DateTimePanel.vue";
import CategoryList from "../components/sidebar/СategoryList.vue";
import TaskList from "../components/TaskList/TaskList.vue";
import {computed, onBeforeMount, onMounted, ref} from "vue";
import UserObservation from "../components/widgets/UserObservation.vue";
import {useUserStore} from "../dict/store/store";
import UserNotAuth from "../components/widgets/UserNotAuth.vue";
import api from "../dict/axios/api";

export default {
    name: "Home",
    components: {UserNotAuth, UserObservation, TaskList, CategoryList, DateTimePanel, Sidebar, TheHeader},
    setup() {
        const showSidebar = ref(false)
        const messages = ref([])


        const {user,tasks,categories,categoriesWithChildren} = useUserStore()
        const isAuth = computed(() => user.isAuth)


        const getCategories = () => {
            try {
                api.get('/categories/with_children').then(res => categoriesWithChildren.value = res.data.data);
                api.get('/categories/all').then(res => categories.value = res.data.data)
            } catch (e) {
                console.error('Ошибка получения данных:', e);
            }
        }

        const getUser = () => {
            if(user.name){
                api.get(`users/${user.name}`).then(res => {
                    if (res?.data?.user) {
                        const data = res.data.user
                        user.id = data.id
                        user.name = data.name
                        user.email = data.email
                        user.phone = data.phone
                        user.role_id = data.role_id
                        user.isAuth = !!localStorage.getItem('access_token')
                    }

                    console.log(user)
                })
            }
        }

        onMounted(() => {
            getCategories()
            getUser()
        })


        return {
            isAuth,
            showSidebar,
            categories,
            messages
        }
    },

}
</script>

<style scoped lang="scss">
@import "../../../css/general";

.list-header {
    color: $green;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
}

.main {
    display: flex;
    gap: 40px;
    justify-content: space-between;
}

.icon-sidebar-open {
    position: fixed;
    left: 20px;
    top: 40px;
    @include icon(30px, 30px, "open_sb");
    z-index: 3;
}

</style>
