<template>
    <TheHeader>
        <v-btn @mousemove="showSidebar = true" class="icon-sidebar-open" variant="text">
            <i> открыть сайдбар </i>
        </v-btn>
    </TheHeader>
    <template v-if="isAuth">
        <div class="body-main">
            <Sidebar v-if="showSidebar">
                <div class="sidebar-overlay" @mousemove="showSidebar = false">
                </div>
            </Sidebar>
            <section class="main">
                <div class="active-task">
                    <v-btn @click="() => getActiveTasks()" variant="text" color="#29a19c">
                        <span class="list-header">Активные задачи</span>
                    </v-btn>
                    <Suspense>
                        <TaskList/>
                        <template #fallback>
                            <p>
                                <Loader/>
                            </p>
                        </template>
                    </Suspense>
                </div>
                <v-container>
                    <DateTimePanel/>
                    <UserObservation/>
                    <UserAchievements/>
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
import Loader from "../components/widgets/Loader.vue";
import UserAchievements from "../components/widgets/UserAchievements.vue";
import {fetchTaskByPage} from "../contracts/сontracts";

export default {
    name: "Home",
    components: {
        UserAchievements,
        Loader, UserNotAuth, UserObservation, TaskList, CategoryList, DateTimePanel, Sidebar, TheHeader},
    setup() {
        const showSidebar = ref(false)
        const messages = ref([])

        const store = useUserStore()
        const {user, tasks, categories, categoriesWithChildren, activeCategory} = storeToRefs(store)
        const isAuth = computed(() => user.value.isAuth)

        const getActiveTasks = async () => {
            activeCategory.value = 0
            const res = await fetchTaskByPage(1)
            tasks.value = res.data

        }

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


.sidebar-overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background-color: rgba(0,0,0,0.2);
    z-index: 3;
}

.list-header {
    color: $green;
    font-size: 20px;
    font-weight: 600;
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
    i{@include icon(30px, 30px, "open_sb");}
    z-index: 4;
}

</style>
