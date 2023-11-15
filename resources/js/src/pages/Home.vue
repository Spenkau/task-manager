<template>
    <TheHeader>
        <i class="icon-sidebar-open" @mousemove="showSidebar = true"> открыть сайдбар </i>
    </TheHeader>
    <template v-if="isAuth">
        <div class="body-main">
            <div class="left" @mousemove="showSidebar=true"></div>
            <Sidebar v-if="showSidebar" @mouseleave="showSidebar = false"/>
            <section class="main">
                <div class="active-task">
                    <v-btn @click="() => getActiveTasks()" variant="text">
                        <h2 class="list-header">Активные задачи</h2>
                    </v-btn>
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
import {computed, onBeforeMount, onMounted, ref, toRefs} from "vue";
import UserObservation from "../components/widgets/UserObservation.vue";
import {useUserStore} from "../dict/store/store";
import UserNotAuth from "../components/widgets/UserNotAuth.vue";
import api from "../dict/axios/api";
import {storeToRefs} from "pinia";

export default {
    name: "Home",
    components: {UserNotAuth, UserObservation, TaskList, CategoryList, DateTimePanel, Sidebar, TheHeader},
    setup() {
        const showSidebar = ref(false)
        const messages = ref([])

        const store = useUserStore()
        const {user, tasks, categories, categoriesWithChildren} = storeToRefs(store)
        const isAuth = computed(() => user.value.isAuth)

        const getActiveTasks = () => {
            api.get('tasks').then(res => tasks.value = res.data.data)
        }

        const getUser = () => {
            try {
                api.post('/me').then(res => {
                    if (res?.data?.name) {
                        user.value.id = res.data.id
                        user.value.name = res.data.name
                        user.value.email = res.data.email
                        user.value.phone = res.data.phone
                        user.value.role_id = res.data.role_id
                        user.value.isAuth = true
                    }
                })
                console.log(user.value)
            } catch (e) {
                console.error("Что-то пошло не так: ", e)
            }
        }

        const getCategories = () => {
            try {
                api.get('/categories/with_children').then(res => categoriesWithChildren.value = res.data.data)
                api.get('/categories/all').then(res => categories.value = res.data.data)
            } catch (e) {
                console.error('Ошибка получения данных: ', e);
            }
        }

        onMounted(() => {
            getUser()
            getCategories()
        })


        return {
            showSidebar,
            categories,
            messages,
            getActiveTasks,
            isAuth
        }
    }
}

</script>

<style scoped lang="scss">
@import "../../../css/general";

.list-header {
    color: $green;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
    width: 200px;
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
