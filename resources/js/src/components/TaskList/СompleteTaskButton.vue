<template>
    <div class="complete-task">
        <button @click="dialog = true">
            <i class="icon-finish">завершить</i>
        </button>
        <v-dialog width="500" v-model="dialog">
            <v-card title="Завершить задачу">
                <v-card-text>
                    Вы уверены что хотите завершить задачу?
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        text="Да"
                        color="#29a19c"
                        @click="() => completeTask()"
                    >
                    </v-btn>
                    <v-btn
                        text="Нет"
                        @click="dialog = false"
                    ></v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import api from "../../dict/axios/api";
import {ref, toRefs} from "vue";
import {useUserStore} from "../../dict/store/store";
import {formatISO8601DateTime} from "../../contracts/сontracts";

const props = defineProps(['taskID'])
const id = props.taskID
const dialog = ref(false)
const store = useUserStore()
const {tasks} = toRefs(store)

const completeTask = async () => {
    try {
        const taskDeleteData = {id: id, status_id: 3, finished_at: formatISO8601DateTime(new Date())}
        await api.post(`task/status_update`, taskDeleteData);

        tasks.value = tasks.value.filter(task => task.id !== id);

        dialog.value = false;
    } catch (error) {
        console.error('Ошибка при завершения задачи:', error);

    }
}


</script>


<style scoped lang="scss">


.complete-task {
    display: flex;
    align-items: center;
    &:hover {
        transform: scale(1.05);
    }

}

</style>
