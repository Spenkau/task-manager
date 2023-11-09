<template>
    <RouterLink :to="'/task/'+ taskItem.id">
        <div class="search-task">
            <div class="search-task-header">
                <RouterLink :to="/task/+taskItem.id">
                    <h3>
                        {{ taskItem.title }}
                    </h3>
                </RouterLink>
                <p class="task-card-tag">
                    <i class="icon-tag">иконка тега</i>
                    <span>Тег</span>
                </p>
            </div>
            <div class="search-task-body">
                <div class="category">
                    <v-icon color="success" icon="$vuetify" size="x-small"/>
                    <span> {{ taskItem.category_id }}</span>
                </div>
                <div class="date">
                    <p>
                        дата
                    </p>
                </div>
            </div>
            <div class="search-task-footer">
                <p>
                    {{ statusTask }}
                </p>
                <i :class="'icon-priority_' + taskItem.priority_id">иконка приоритета</i>
            </div>
        </div>
    </RouterLink>
</template>

<script setup lang="ts">
import {computed} from "vue";
import {ITask} from "../../interfaces/interfaces";

const task = defineProps(['task'])
const taskItem = computed(() => task.task as ITask);
console.log(taskItem.value)
// const dateTask = computed(()=>{
//     if (taskItem.value.started_at && taskItem.value.finished_at){
//         return `с ${task.value.started_at} по ${task.value.finished_at}`
//     } else {
//         return 'Дата не указана'
//     }
// })

const statusTask = computed(() => {
    switch (taskItem.value.status_id) {
        case 0:
            return "Заброшено";
        case 1:
            return "В процессе";
        case 2:
            return "Отложенно";
        case 3:
            return "Завершено";
    }
})
</script>

<style scoped lang="scss">
@import "../../../../css/general";

.search-task {
    background-color: $abs-white;
    padding: 20px;
    width: 230px;
}

.search-task-header {
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-bottom: 15px;

    h3 {
        font-size: 18px;
        max-width: 120px;
        word-wrap: break-word;
    }
}

.search-task-body {
    margin-bottom: 15px;

    .category {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
        opacity: 0.6;
        margin-bottom: 10px;

        .icon-category {
            width: 15px;
            height: 15px;
        }
    }

    .date {
        display: flex;
        align-items: center;
        justify-content: center;

        p {
            width: 100px;
            font-size: 16px;
            line-height: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
    }
}

.search-task-footer {
    display: flex;
    align-items: center;
    justify-content: space-around;
    gap: 10px;

    p {
        display: flex;
        align-items: center;
        gap: 10px;

        .icon-process {
            width: 20px;
            height: 20px;
        }

    }

}

.task-card-tag {
    display: flex;
    align-items: center;
    gap: 10px;
    color: hsl(206, 100%, 40%);
    background-color: hsl(206, 96%, 90%);
    padding: 5px 7px;
    border-radius: 5px;
}
</style>
