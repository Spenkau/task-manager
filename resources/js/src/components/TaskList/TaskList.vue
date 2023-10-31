<template>
    <ul>
        <li v-for="(task, key) in tasks" :key="key">
            <TaskItem :task="task"/>
        </li>
    </ul>
</template>

<script setup async lang="ts">
import {ITasks} from "../../interfaces/interfaces"
import TaskItem from "./TaskItem.vue";
import {onMounted, ref} from "vue";
import {useTasksQuery} from "../../contracts/сontracts";

//const {data, isLoading, isError} = useTasksQuery();
const tasksData = ref<ITasks | []>([])
tasksData.value = await fetch('http://127.0.0.1:8000/api/tasks').then(res => res.json())

const tasks =  tasksData.value.tasks.data


</script>

<style scoped lang="scss">

</style>
