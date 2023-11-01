<template>
    <div class="task-page">
        <div class="task-page-container">
            <RouterLink to="/main"><i class="icon-arrow-back">иконка назад</i> Вернуться</RouterLink>
            <h1 class="task-name">{{task.title}}</h1>
            <h2 class="task-category">категория {{task.category_id}}</h2>
            <div class="task-options">
                <p class="task-status">
                   {{statusTask}}
                </p>
                <p class="task-priority"> Приоритет
                    <i :class="'icon-priority_' + task.priority_id" >иконка приоритета</i>
                </p>
                <p class="task-date">
                    {{dateTask}}
                </p>
            </div>
            <p class="task-content">{{task.content}}</p>
            <div class="task-settings">
                <button><i class="icon-rewrite"></i> редатктировать</button>

                <button><i class="icon-share"></i> поделиться</button>

                <button><i class="icon-postpone"></i> отложить</button>

            </div>
            <button class="task-page-delete"><i class="icon-delete"> иконка удалить</i></button>
            <button class="task-page-complete"><i class="icon-complete"> иконка завершить</i></button>
            <div class="write-comment">
                <form action="" method="post">
                    <v-text-field clearable type="text" label="Оставьте комментарий для задачи.." name="comment"  variant="underlined"></v-text-field>
                    <input type="submit" value="Отправить" class="input-submit-commit disabled">
                </form>
            </div>
            <div class="task-comments">
                <ul class="comment-list">
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Maxim</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque
                                    eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam
                                    saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="right">
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Alex</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque
                                    eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam
                                    saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Andry</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque
                                    eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam
                                    saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">CJ</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque
                                    eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam
                                    saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Cebastian</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque
                                    eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam
                                    saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Dolly</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque
                                    eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam
                                    saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import {useRoute, useRouter} from "vue-router";
import {ref, onBeforeMount, reactive, computed} from "vue";
import {ITask} from "../interfaces/interfaces";


const route = useRoute();
const taskId = route.params.id
const router = useRouter()
const task = ref<ITask | {}>({})

onBeforeMount(async () => {
    const res = await fetch(`http://127.0.0.1:8000/api/tasks/${taskId}`)
    if (res.status === 404) {
        router.replace({name: 'NotFoundPage'})
    } else {
        const {tasks} = await res.json()

        task.value = await tasks
    }

})


const dateTask = computed(()=>{
    if (task.value.started_at && task.value.finished_at){
        return `с ${task.value.started_at} по ${task.value.finished_at}`
    } else {
        return 'Дата не указана'
    }
})

const statusTask = computed(()=>{
    switch (task.value.status_id){
        case 0:
            return "Заброшенно"
        case 1:
            return "В процессе"
        case 2:
            return "Отложенно"
        case 4:
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


.task-page-complete, .task-page-delete {
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 25px;
    bottom: 0;
    transition: padding 200ms ease-in-out;

    &:hover {
        padding: 35px;
    }

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


.task-comments {
    margin-top: 60px;
    width: 920px;

    img {
        width: 64px;
        height: 64px
    }
}

.comment-list {
    display: block;


    li {
        width: min-content;
        margin-bottom: 45px;

        &:nth-child(even) {
            .user-comment {
                display: flex;
                flex-direction: row-reverse;
                justify-content: space-between;
            }

            margin-left: auto;

            .comment {
                order: 1;
            }

            img {
                order: 0;
            }

            .user-name {
                justify-content: flex-end;
            }
        }
    }
}

.user-comment {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}

.user-name {
    margin-bottom: 10px;
}

.comment-text {
    width: 450px;
    line-height: 23px;
    text-align: justify;
    opacity: 0.8;
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

.write-comment {
    margin-top: 80px;
    width: 100%;

    input[type="submit"] {
        margin-left: 90%;
        padding: 8px;
        border: none;
        background-color: transparent;
        opacity: 0.4;
        font-family: $main-font;
        border-radius: 15px;
        cursor: pointer;

        &:hover {
            opacity: 1;
            background-color: $green;
            color: $abs-white;
        }
    }
}

</style>
