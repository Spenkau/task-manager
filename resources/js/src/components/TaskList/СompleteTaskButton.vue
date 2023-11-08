<template>
    <div class="complete-task">
        <button @click="() => completeTask()">
           <i class="icon-complete">завершить</i>
        </button>
    </div>
</template>

<script setup>
import api from "../../dict/axios/api";

const props = defineProps(['taskID'])
const id = props.taskID


const taskDeleteData = {id:id,finished_at:new Date().toLocaleString()}

const completeTask = () => {
    api.post('tasks/finish', taskDeleteData).then(res => console.log(res))
}
</script>

<style scoped lang="scss">
    .complete-task{
        display: flex;
        align-items: center;
    }
    i{
        background-color: grey;
    }
</style>
