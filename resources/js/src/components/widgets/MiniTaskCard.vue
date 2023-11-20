<template>
    <RouterLink :to="'/task/'+ task.id">
        <div class="search-task">
            <div class="search-task-header">
                <h3>
                    {{ task.title }}
                </h3>
                <p class="task-card-tag" v-if="task.tags">
                    <i class="icon-tag">иконка тега</i>
                    <span>Тег</span>
                </p>
            </div>
            <div class="search-task-body">
                <div class="category">
                    <v-icon color="success" icon="$vuetify" size="x-small"/>
                    <span> {{ task.category.name }}</span>
                </div>
                <div>
                    {{ dateTask }}
                </div>
            </div>
            <div class="search-task-footer">
                {{statusTask}} <i :class="'icon-priority_' + task.priority_id">иконка приоритета</i>
            </div>
        </div>
    </RouterLink>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import api from "../../dict/axios/api"

const props = defineProps(['task'])
const task = ref(props.task);
const dateStarted = computed(() => {
    return new Date(task.value.started_at).toLocaleDateString(
        ["by", "ru"],
        {weekday: 'long', month: 'long', day: 'numeric'}
    )
})
const dateFinished = computed(() => {
    return new Date(task.value.finished_at).toLocaleDateString(
        ["by", "ru"],
        {weekday: 'long', month: 'long', day: 'numeric'}
    )
})
const dateTask = computed(() => {
    if (task.value.started_at && task.value.finished_at) {
        return `${dateStarted.value} по ${dateFinished.value}`
    } else {
        return 'Дата не указана'
    }
})
const statusTask = computed(() => {
    switch (task.value.status_id) {
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
