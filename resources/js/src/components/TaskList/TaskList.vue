<template>
    <ul>
        <li v-for="(task, key) in tasks" :key="key">
            <TaskItem :task="task"/>
        </li>
    </ul>
    <v-container v-if="tasksMoreFive">
        <v-pagination
            v-model="currentPage"
            :length="totalPage"
            :total-visible="5"
            prev-icon="mdi-menu-left"
            next-icon="mdi-menu-right"
        ></v-pagination>
    </v-container>
</template>

<script setup async lang="ts">

import {computed, ref, toRefs, watchEffect} from "vue";
import {fetchTaskByPage} from "../../contracts/сontracts";
import TaskItem from "./TaskItem.vue"
import {useUserStore} from "../../dict/store/store";

const store = useUserStore()
const {tasks} = toRefs(store)


const currentPage = ref(1);
let tasksData = await fetchTaskByPage(currentPage.value)
const totalPage = ref(Number(tasksData.meta.last_page))
tasks.value = tasksData.data

const tasksMoreFive = computed(() => {
    return tasks.value.length === 5
})

watchEffect(async () => {
    const tasksData = await fetchTaskByPage(currentPage.value);
    tasks.value = tasksData.data;
});

</script>

<style scoped lang="scss">
ul {
    display: flex;
    flex-direction: column;
    gap: 40px;
}
</style>
