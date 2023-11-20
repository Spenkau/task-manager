<template>
    <div class="delete-task">
        <button @click="dialog = true">
            <i class="icon-bugs">удалить</i>
        </button>
        <v-dialog width="500" v-model="dialog">
                <v-card title="Удаление">
                    <v-card-text>
                        Вы уверены что хотите удалить задачу?
                    </v-card-text>
                    <v-card-actions>
                        <div class="btn-actions">
                            <v-btn
                                text="Да"
                                color="#29a19c"
                                @click="() => deleteTask()"
                            >
                            </v-btn>
                            <v-btn
                                text="Нет"
                                @click="dialog = false"
                            ></v-btn>
                        </div>
                    </v-card-actions>
                </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import {computed, ref, toRefs} from "vue";
import api from "../../dict/axios/api";
import {useUserStore} from "../../dict/store/store";

const props = defineProps(['taskID'])
const id = props.taskID
const store = useUserStore()
const {tasks} = toRefs(store)
const dialog = ref(false)

const deleteTask = async () => {
    try {

        await api.delete(`task/delete/${id}`);

        tasks.value = tasks.value.filter(task => task.id !== id);

        dialog.value = false;
    } catch (error) {
        console.error('Ошибка при удалении задачи:', error);

    }
};
</script>

<style scoped lang="scss">
.delete-task{
    display: flex;
    align-items: center;
    &:hover {
        transform: scale(1.35);

    }
}

.btn-actions{
    display: flex;
    justify-content: space-between;
    width: 100%;
}

</style>
