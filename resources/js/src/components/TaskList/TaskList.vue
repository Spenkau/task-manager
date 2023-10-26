<template>
    <ul>
        <li v-for="task in taskList" :key="task.id">
            <TaskItem :task="task"/>
        </li>
    </ul>
</template>

<script lang="ts">
import {ITasks} from "../../interfaces/interfaces"
import TaskItem from "./TaskItem.vue";

export default {
    name: "TaskList",
    components: {TaskItem},
    setup(){

    },
    data() {
        return {
            taskList: [] as ITasks | []
        }
    },
    methods: {
        async getTasks() {
            try {
                const res = await fetch('http://127.0.0.1:8000/api/tasks',{method:"get"});
                if (res.status === 418) {
                    const data = await res.json();
                    this.taskList = data.tasks
                }
            } catch (e) {
                console.error('Ошибка получения данных:', e);
            }
        }
    },
    mounted() {
        this.getTasks()
    }
}
</script>

<style scoped lang="scss">

</style>
