<template>
    <div class="task-page">
        <div class="task-page-container">
            <RouterLink to="/main"><i class="icon-arrow-back">иконка назад</i> Вернуться</RouterLink>
            <h1 class="task-name">{{ task.title }}</h1>
            <h2 class="task-category">категория {{ task.category_id }}</h2>
            <div class="task-options">
                <p class="task-status">
                    {{ statusTask }}
                </p>
                <p class="task-priority"> Приоритет
                    <i :class="'icon-priority_' + task.priority">иконка приоритета</i>
                </p>
                <p class="task-date">
                    {{ dateTask }}
                </p>
            </div>
            <p class="task-content">{{ task.content }}</p>
            <div class="task-settings">
                <button @click="show = true"><i class="icon-rewrite"></i> редатктировать</button>

                <button><i class="icon-share"></i> поделиться</button>

                <button><i class="icon-postpone"></i> отложить</button>
            </div>
            <EditTaskModal v-if="show" :task="task">
                <div class="overlay" @click="show = false"/>
            </EditTaskModal>
            <button class="task-page-delete"><i class="icon-delete"> иконка удалить</i></button>
            <button class="task-page-complete"><i class="icon-complete"> иконка завершить</i></button>
            <InputComment/>
            <CommentList/>
        </div>
    </div>
</template>

<script setup>

import {useRoute, useRouter} from "vue-router";
import {ref, onBeforeMount, reactive, computed} from "vue";
import {fetchTaskByID} from "../contracts/сontracts";
import CommentList from "../components/CommentList/CommentList.vue";
import InputComment from "../components/CommentList/InputComment.vue";
import EditTaskModal from "../components/widgets/EditTaskModal.vue";


const route = useRoute();
const taskId = route.params.id
const router = useRouter()
const task = ref({})
const show = ref(false)

onBeforeMount(() => {
        fetchTaskByID(taskId)
            .then(data => task.value = data.tasks)
    }
)

const dateTask = computed(() => {
    if (task.value.started_at && task.value.finished_at) {
        return `с ${task.value.started_at} по ${task.value.finished_at}`
    } else {
        return 'Дата не указана'
    }
})

const statusTask = computed(() => {
    switch (task.value.status) {
        case 0:
            return "Заброшенно"
        case 1:
            return "В процессе"
        case 2:
            return "Отложенно"
        case 3:
            return "Выполенно"
    }
})


</script>

<style scoped lang="scss">
@import "../../../css/general";


.icon-arrow-back {
    @include icon(25px, 25px, "arrow-back");
}

.link-back {
    display: flex;
    gap: 10px;
    align-items: center;
}

.task-page {
    min-height: 760px;
    font-size: 18px;
    display: flex;
    justify-content: center;
    padding: 50px 90px;
    background: $white url("/public/images/bg/circle.svg") repeat 1370px -150px;
    background-size: 25%;
}

.task-name {
    font-size: 48px;
    font-weight: 700;
    margin: 32px 0 10px 0;
    text-align: center;
}


.task-content {
    max-width: 920px;
    font-size: 22px;
    line-height: 35px;
    text-align: justify;
}


.icon-process {
    @include icon(32px, 32px, 'process')
}

.task-status {
    display: flex;
    align-items: center;
    gap: 10px;
}


.task-category {
    text-align: center;
    opacity: 0.4;
    margin-bottom: 70px;
}


.task-priority {
    display: flex;
    gap: 10px;
    align-items: center;

    i {
        width: 21px;
        height: 30px;
    }
}

.task-options {
    display: flex;
    justify-content: space-around;
    margin-bottom: 30px;
    align-items: center;

    .task-date {
        opacity: 0.4;
        margin-bottom: 0;
        padding-bottom: 0;

    }
}


.task-page-complete, .task-page-delete, .task-page-edit {
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 25px;
    bottom: 0;
    transition: padding 200ms ease-in-out;
    z-index: 5;
    &:hover {
        padding: 35px;
    }

}

.task-page-edit{
    height: min-content;
    top:0;
    right: 0;
    background-color: #4b5563;
    border-bottom-left-radius: 35px;
}

.task-page-delete {
    left: 0;
    background-color: $red;
    border-top-right-radius: 25px;
}

.task-page-complete {
    right: 0;
    background-color: $green;
    border-top-left-radius: 25px;
}

.task-settings {
    margin-top: 45px;
    display: flex;
    justify-content: space-around;

    button {
        display: flex;
        gap: 10px;
    }
}


.input-page {
    &::placeholder {
        color: $black;
        opacity: 0.4;
    }

    display: block;
    width: 100%;
    padding: 0 20px;
    background: transparent;
    border: none;
    border-bottom: 2px solid $black;
    line-height: 40px;
    margin-bottom: 5px;
    font-size: 16px;
    font-family: $main-font;

    &:focus {
        border-bottom: 2px solid transparent;
    }

    &:invalid {
        border: 1px solid $red;
    }

}

</style>
