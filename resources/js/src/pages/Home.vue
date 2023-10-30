<template>
    <TheHeader>
        <i class="icon-sidebar-open" @mousemove="showSidebar = true"> открыть сайдбар </i>
    </TheHeader>
    <div class="body-main">
        <div class="left" @mousemove="showSidebar=true"></div>
        <Sidebar v-if="showSidebar" @mouseleave="showSidebar=false">
            <CategoryList :categories="categories"/>
        </Sidebar>
        <section class="main">
            <div class="active-task">
                <h2 class="list-header">Активные задачи</h2>
                <Suspense>
                    <TaskList/>
                    <template #fallback>
                        <p>ОЖИДАНИЕ ДАННЫХ</p>
                    </template>
                </Suspense>

                <p v-for="message in messages">
                    {{message}}
                </p>
            </div>
            <DateTimePanel/>
        </section>
    </div>
</template>

<script>
import TheHeader from "../components/header/TheHeader.vue";
import Sidebar from "../components/sidebar/Sidebar.vue";
import DateTimePanel from "../components/DateTimePanel.vue";
import CategoryList from "../components/sidebar/СategoryList.vue";
import TaskList from "../components/TaskList/TaskList.vue";
import {onMounted, ref} from "vue";

export default {
    name: "Home",
    components: {TaskList, CategoryList, DateTimePanel, Sidebar, TheHeader},
    setup() {
        const showSidebar = ref(false)
        const categories = ref([])
        const messages = ref([])


        const getCategories = async () => {
            try {
                const res = await fetch('http://127.0.0.1:8000/api/categories/with_children');
                if (res.ok) {
                    const data = await res.json();
                    categories.value = data.data

                }
            } catch (e) {
                console.error('Ошибка получения данных:', e);
            }
        }

        onMounted(()=>{
            getCategories()
            console.log('e')
            try{

                window.Echo.channel('public')
                    .listen('.button.clicked', (e) => {
                        console.log('go public');
                        //code for displaying the serve data
                        console.log(e); // the data from the server
                    })
                    .listen('.message', (e) => {
                        console.log('go public');
                        messages.value.push(e.message)
                    })
                    .error((error)=>{
                        console.error('Error:', error);
                    })

            } catch (e) {
                console.error(e)
            }
        })

        return {
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
    position: absolute;
    left: 20px;
    top: 40px;
    @include icon(30px, 30px, "open_sb");
    z-index: 3;
}

</style>
