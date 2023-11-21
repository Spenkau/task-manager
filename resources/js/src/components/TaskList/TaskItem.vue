<template>
    <div>
        <div class="tasks-container" v-if="taskItem">
            <div class="item-task">
                <div class="task-card">
                    <div class="task-header">
                        <div class="task-card-date">
                        <span v-if="dateIsNull">
                            Дата не указана
                        </span>
                            <template v-else>
                                <div class="date">
                                    <div class="span">
                                        <span>по</span>
                                    </div>
                                    <div>
                                        <span>{{ dateStarted }}</span>
                                        <span>{{ dateFinished }}</span>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <p class="task-card-category">
                            <v-icon color="success" icon="$vuetify" size="x-large"/>
                            <span>{{ taskItem.category.name }}</span>
                        </p>
                        <div class="task-card-reaction">
                            <div class="reaction-content">
                                <a href="/user/1">
                                    <img src="/images/reaction/reaction_13.png" alt="реакция">
                                </a>
                                <span>3</span>
                            </div>
                            <div class="reaction-content">
                                <a href="/user/1">
                                    <img src="/images/reaction/reaction_14.png" alt="реакция">
                                </a>
                                <span>6</span>
                            </div>
                            <div class="reaction-content">
                                <a href="/user/1">
                                    <img src="/images/reaction/reaction_10.png" alt="реакция">
                                </a>
                                <span>2</span>
                            </div>
                        </div>
                    </div>
                    <div class="task-body">
                        <h3>
                            <RouterLink :to="'/user/' + user.name + '/task/' + taskItem.id">{{
                                    taskItem.title
                                }}
                            </RouterLink>
                        </h3>
                        <div>
                            <ul class="tag-list" v-if="taskItem.tags && taskItem.tags.length > 0">
                                <li class="task-card-tag" v-for="(tag, key) in taskItem.tags || []" :key="key">
                                    <i class="icon-tag">иконка тега</i>
                                    <RouterLink :to="'/user/'+ user.name +'/tags'"><span>{{ tag.name }}</span>
                                    </RouterLink>
                                </li>
                            </ul>
                        </div>
                        <i :class="'icon-priority_'+ taskItem.priority_id">иконка приоритета</i>
                    </div>
                    <div class="task-pre-footer">
                        <div class="add-button-child">
                            <button @mousemove="addButton = true">
                                <i class="icon-add_child">
                                    иконка добавить задачу
                                </i>
                            </button>
                        </div>
                        <div class="child-button" :class="addButton? 'activate':null" @mouseleave="addButton = false">
                            <button @click="addChild = true">
                                Добавить подзадачу
                            </button>
                        </div>
                        <NewTaskModal v-if="addChild" :parentID="taskItem.id">
                            <div class="overlay" @click="addChild = false"></div>
                        </NewTaskModal>
                    </div>
                    <div>
                        <div class="task-footer">
                            <DeleteTaskButton :taskID="taskItem.id"/>
                            <button @click="show = true"><i class="icon-rewrite"></i> редактировать</button>
                            <EditTaskModal v-if="show" :task="taskItem">
                                <div class="overlay" @click="show = false"/>
                            </EditTaskModal>

                            <button><i class="icon-share"></i> поделиться</button>
                            <button><i class="icon-postpone"></i> отложить</button>
                            <CompleteTaskButton :taskID="taskItem.id"/>
                        </div>
                        <div>
                            <button
                                v-if="taskItem.children.length"
                                class="button-child-task"
                                :class="isShowChildTask? 'hide':'show'"
                                @click="isShowChildTask = !isShowChildTask"
                            >{{ isShowChildTask ? 'Скрыть' : 'Показать вложенные задачи' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <Transition name="slide-fade">
                <div v-if="isShowChildTask">
                    <ul class="children-list">
                        <li v-for="(task, key) in children || []" :key="key">
                            <TaskItem :task="task"/>
                        </li>
                    </ul>
                </div>
            </Transition>
        </div>
    </div>
</template>

<script setup lang="ts">
import {ITask} from "../../interfaces/interfaces";
import {ref, toRefs, computed, reactive, onMounted} from "vue";
import CompleteTaskButton from "./СompleteTaskButton.vue";
import DeleteTaskButton from "./DeleteTaskButton.vue";
import {useUserStore} from "../../dict/store/store";
import EditTaskModal from "../widgets/EditTaskModal.vue";
import TaskItem from "./TaskItem.vue";
import NewTaskModal from "../header/NewTaskModal.vue";
import axios from "axios";

const store = useUserStore()
const {user, categories} = store
const show = ref(false)
const task = defineProps(['task'])
const taskItem = computed(() => task.task as ITask);
const isShowChildTask = ref(false)

const dateIsNull = computed(() => {
    return taskItem.value.started_at === null && taskItem.value.finished_at === null
})

const dateStarted = computed(() => {
    return new Date(taskItem.value.started_at).toLocaleDateString(
        ["by", "ru"],
        {weekday:'long', month: 'long', day: 'numeric'}
    )
})

const dateFinished = computed(() => {
    return new Date(taskItem.value.finished_at).toLocaleDateString(
        ["by", "ru"],
        {weekday:'long',month: 'long', day: 'numeric'}
    )
})

const children = computed(() => taskItem.value.children)
const childrenNotNull = computed(() => !!taskItem.value.children)
const addChild = ref(false)
const addButton = ref(false)

</script>

<style scoped lang="scss">
@import "../../../../css/general";

.task-pre-footer {
    display: flex;
    align-items: center;
}

.add-button-child {
    button {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px;
        border: 1px solid rgba(41, 161, 156, 0.3);
        border-left: 0;
    }
}


.child-button {
    display: none;
    width: 100%;
    justify-content: center;
    align-items: center;
    margin: 5px 0;
    background-color: #FAFAFA;
    animation: active 350ms linear;
    border: 1px solid rgba(41, 161, 156, 0.3);
    border-left: 0;
    border-right: 0;
    font-size: 10px;
    font-style: italic;

    button {
        padding: 7px 0;
        opacity: 0.7;

    }
}

.activate {
    display: flex;
}

@keyframes active {
    0% {
        width: 0;
    }
    100% {
        width: 100%
    }
}

.overlay {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    background-color: rgb(40, 40, 70, .2);;
}

.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}

.button-child-task {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    height: 30px;
    padding: 10px;

    &:hover {
        color: white;
        box-shadow: 0 0 1px 1px rgba(111, 97, 97, 0.29) inset;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
}

.show {
    &:hover {
        background-color: rgba(41, 161, 156, .7);
    }
}

.hide {
    &:hover {
        background-color: rgba(240, 84, 84, 0.7);
    }
}

.children-list {
    display: flex;
    flex-direction: column;
    gap: 35px;
    padding: 35px;
    background-color: rgba(41, 161, 156, .05);
    border-radius: 10px;
}

.task-card-date {
    max-width: 220px;
    .date{
        display: flex;
    }

    .span {
        display: flex;
        align-items: center;
        margin-right: 5px;
    }

    span {
        display: flex;
        flex-wrap: nowrap;
        margin-bottom: 5px;
    }
}

.tag-list {
    display: flex;
    gap: 15px;
}

.item-task {
    display: flex;
}

.task-card {
    width: 45vw;
    background-color: $bg-white;
    border-radius: 10px;
    border: 1px solid rgba(41, 161, 156, 0.3);
}


.task-complete, .task-delete {
    position: absolute;
    width: 100px;
    height: 100%;
    justify-content: center;
    align-items: center;

    button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        padding: 0;
        color: $white;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

}

.task-delete {
    display: none;
    background-color: $red;
    border-radius: 10px;
    transition: left 200ms ease;

    button {
        border-radius: 10px 0 0 10px;
    }

}


.task-complete {
    right: 0;
    display: none;
    background-color: $green;
    border-radius: 10px;
    transition: right 200ms ease;

    button {
        border-radius: 0 10px 10px 0;
    }
}


.activate {
    display: flex;
}

.task-header {
    color: rgba(40, 40, 70, 0.3);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 20px 20px 0;
}

.task-card-category {
    display: flex;
    align-items: center;
    gap: 7px;

    i {
        width: 13px;
        height: 13px;
    }
}

.task-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
    margin-bottom: 25px;
    padding: 0 25px;


    h3 {
        a {
            color: $black;
            font-size: 20px;

            &:hover {
                color: rgba(40, 40, 70, 0.7);
            }
        }
    }

    i:last-child {
        width: 13px;
        height: 18px;
    }

    i:first-child {
        width: 19px;
        height: 19px;
    }
}

.task-footer {
    display: flex;
    justify-content: space-around;
    padding-bottom: 20px;

    button {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 10px;
        color: rgba(40, 40, 70, 0.7);
        background-color: transparent;
        border: none;
    }

    .toggle-show-child {
        font-size: 14px;

    }
}


.task-list {
    padding: 0 50px;
    border-radius: 8px;

    .list-header {
        color: $green;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
    }

}

.pagination-tasks {
    display: flex;
    margin: 0 auto;
    background-color: $abs-white;
    border: 1px solid rgba(41, 161, 156, 0.3);
    width: min-content;
    border-radius: 5px;
    font-size: 18px;

    nav {
        display: flex;

        svg {
            width: 25px;
        }

        .flex {
            display: none;
        }

        p.text-sm {
            display: none;
        }

        span.relative {
            display: flex;
            align-items: center;
            gap: 10px;
            color: $black;
        }

        span.cursor-default {
            opacity: .4;
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

.task-card-reaction {
    display: flex;
    gap: 10px;

    img {
        width: 41px;
        height: 36px;

    }

    .reaction-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;

        span {
            color: hsl(206, 100%, 40%);
        }
    }
}

.child {
    padding-left: 90px;

    .task-card {
        width: 90%;
    }

    .task-header {
        gap: 27px;
    }
}


.full-task-card {
    border: 1px solid rgba(41, 161, 156, 0.3);
    border-radius: 10px;
    padding-bottom: 30px;
    margin-bottom: 30px;

    .task-card {
        border: none;
    }

    .child {
        .full-task-card {
            border: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .task-card {
            border: 1px solid rgba(41, 161, 156, 0.3)
        }
    }
}

</style>
