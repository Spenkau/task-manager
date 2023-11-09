<template>
    <ul>
        <li v-for="(task, key) in tasksList" :key="key">
            <TaskItem :task="task"/>
        </li>
    </ul>
    <v-container v-if="tasks.data = 5">
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

import {ref, watchEffect} from "vue";
import {fetchTaskByPage} from "../../contracts/сontracts";
import TaskItem from "./TaskItem.vue"
import {useUserStore} from "../../dict/store/store";

const store = useUserStore()
const tasks = store.tasks



const currentPage = ref(1);
let tasksData = await fetchTaskByPage(currentPage.value)
const totalPage = ref(Number(tasksData.meta.last_page))
tasks.data = tasksData.data
const tasksList = ref(tasks.data)

watchEffect(async () => {
    const tasksData = await fetchTaskByPage(currentPage.value);
    tasks.data = tasksData.data;
    tasksList.value = tasks.data
});

</script>

<style scoped lang="scss">

</style>
