<template>
    <ul>
        <li v-for="(task, key) in tasks" :key="key">
            <TaskItem :task="task"/>
        </li>
    </ul>
    <v-container>
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

const currentPage = ref(1);
let tasksData = await fetchTaskByPage(currentPage.value)
const totalPage = ref(Number(tasksData.meta.last_page))
const tasks =  ref(tasksData.data)


watchEffect(async () => {
    const tasksData = await fetchTaskByPage(currentPage.value);
    tasks.value = tasksData.data;
});

</script>

<style scoped lang="scss">

</style>
