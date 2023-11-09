<template>
    <div class="delete-task">
        <v-btn @click="() => deleteTask()">
            удалить
        </v-btn>
    </div>
</template>

<script setup>
import {computed} from "vue";
import api from "../../dict/axios/api";

const props = defineProps(['taskID'])
const id = props.taskID
const taskDeleteData = {id}
const deleteTask = () => {
    api.post('tasks/delete', taskDeleteData).then(res => console.log(res))
}

</script>

<style scoped lang="scss">
.delete-task{
    button {
        width: 100%;
    }
}
</style>
