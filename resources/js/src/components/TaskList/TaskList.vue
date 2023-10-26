<template>
    <ul v-if="!isLoading">
        <li v-for="task in tasks" :key="task.id">
            <TaskItem :task="task"/>
        </li>
    </ul>
    <div v-else>
        Загрузка данных
    </div>
</template>

<script lang="ts">
import {ITasks} from "../../interfaces/interfaces"
import TaskItem from "./TaskItem.vue";
import {onMounted, ref} from "vue";
import {useTasksQuery} from "../../contracts/сontracts";

export default {
    name: "TaskList",
    components: {TaskItem},
    setup() {
        const tasks = ref<ITasks | []>([])

        const {data, isLoading, isError} = useTasksQuery()

        onMounted(()=>{
            if (!isLoading.value && !isError.value) {
                tasks.value = data.value.tasks;
            }
        })

        return {
            tasks,
            isLoading
        }


    }
}

</script>

<style scoped lang="scss">

</style>
