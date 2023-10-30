<template>
    <ul v-if="!isLoading">
        <li v-for="(task,key) in tasks" :key="key">
            <TaskItem :task="task"/>
        </li>
    </ul>
    <div v-else>
        Загрузка данных
    </div>
</template>

<script setup lang="ts">
import {ITasks} from "../../interfaces/interfaces"
import TaskItem from "./TaskItem.vue";
import {onMounted, ref} from "vue";
import {useTasksQuery} from "../../contracts/сontracts";

const {data, isLoading, isError} = useTasksQuery()

</script>

<style scoped lang="scss">

</style>
