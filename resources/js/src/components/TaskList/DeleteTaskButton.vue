<template>
    <div class="delete-task">
        <button @click="() => deleteTask()">
            <i class="icon-bugs">удалить</i>
        </button>
    </div>
</template>

<script setup>
import {computed} from "vue";
import api from "../../dict/axios/api";

const props = defineProps(['taskID'])
const id = props.taskID
// const taskDeleteData = {id}
const deleteTask = () => {
    api.delete(`tasks/delete/${id}`).then(res => console.log(res))
}

</script>

<style scoped lang="scss">
.delete-task{
    display: flex;
    align-items: center;
    &:hover{
        transform: scale(1.25);
    }
}

</style>
