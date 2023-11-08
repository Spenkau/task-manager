<template>
    <div class="modal">
        <slot></slot>
        <div class="edit-modal">
            <div class="name-status-group">
                <v-text-field
                    type="text"
                    :label="taskItem.title"
                    hide-details="auto"
                    name="title"
                    variant="outlined"
                    clearable
                >
                </v-text-field>
                <v-select
                    clearable
                    label="Приоритет"
                    :items="[1,2, 3]"
                    variant="outlined"
                    name="priority_id"
                ></v-select>
            </div>
            <v-select
                clearable
                label="Категория"
                :items="[1, 2, 3, 3, 5, 10]"
                variant="outlined"
                name="category_id"
            ></v-select>
            <v-textarea
                type="text"
                label="Описание задачи..."
                hide-details="auto"
                name="content"
                variant="outlined"
                clearable
                class="textarea"
            ></v-textarea>
            <div class="task-date">
                <v-text-field
                    type="date"
                    label="Дата начала"
                    hide-details="auto"
                    name="started_at"
                    variant="outlined"
                    clearable
                ></v-text-field>
                <v-text-field
                    type="date"
                    label="Дата завершения"
                    hide-details="auto"
                    name="finished_at"
                    variant="outlined"
                    clearable
                ></v-text-field>
            </div>
            <v-btn variant="outlined" text="Изменить"/>
        </div>
    </div>
</template>

<script setup>
import {computed, reactive} from "vue";

const task = defineProps(['task'])
const taskItem = computed(()=>task.task)
const editedTask = reactive({
    title:taskItem.title

})
</script>

<style scoped>

.modal{
    position: fixed;
    z-index: 10;
}

.edit-modal{
    position: fixed;
    z-index: 15;
    width: 35vw;
    padding: 2vw;
    background-color: white;
    border-radius: 35px;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
</style>
