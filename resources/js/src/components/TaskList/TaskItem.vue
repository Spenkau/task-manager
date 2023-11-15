<template>
    <div class="tasks-container" v-if="taskItem">
        <div class="item-task">
            <div class="task-card">
                <div class="task-header">
                    <p class="task-card-date">
                        <span v-if="dateIsNull">
                            Дата не указана
                        </span>
                        <template v-else>
                            <span>{{ taskItem.started_at }}</span>
                            по
                            <span>{{ taskItem.finished_at }}</span>
                        </template>
                    </p>
                    <p class="task-card-category">
                        <v-icon color="success" icon="$vuetify" size="x-large"/>
                        <span>{{ taskItem.category_id }}</span>
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
                                <RouterLink :to="'/user/'+ user.name +'/tags'"><span>{{ tag.name }}</span></RouterLink>
                            </li>
                        </ul>
                    </div>
                    <i :class="'icon-priority_'+ taskItem.priority_id">иконка приоритета</i>
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
                        >{{isShowChildTask?'Скрыть':'Показать вложенные задачи'}}
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
</template>

<script setup lang="ts">
import {ITask} from "../../interfaces/interfaces";
import {ref, toRefs, computed, reactive, onMounted} from "vue";
import CompleteTaskButton from "./СompleteTaskButton.vue";
import DeleteTaskButton from "./DeleteTaskButton.vue";
import {useUserStore} from "../../dict/store/store";
import EditTaskModal from "../widgets/EditTaskModal.vue";
import TaskItem from "./TaskItem.vue";

const store = useUserStore()
const {user, categories} = store
const show = ref(false)
const task = defineProps(['task'])
const taskItem = computed(() => task.task as ITask);
const isShowChildTask = ref(false)

const dateIsNull = computed(() => {
    return taskItem.value.started_at === null && taskItem.value.finished_at === null
})
const children = computed(()=> taskItem.value.children)


</script>

<style scoped lang="scss">
@import "../../../../css/general";

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

.button-child-task{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    height: 30px;
    padding: 10px;
    &:hover{
        color: white;
        box-shadow: 0 0 1px 1px rgba(111,97,97,0.29) inset;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
}
.show{
    &:hover{background-color: rgba(41, 161, 156, .7);}
}

.hide{
    &:hover{background-color: rgba(240, 84, 84, 0.7);}
}

.children-list{
    padding: 35px;
    background-color: rgba(41, 161, 156, .4);
    border-radius: 10px;
}

.task-card-date {
    max-width: 140px;
}

.tag-list {
    display: flex;
    gap: 15px;
}

.item-task {
    display: flex;
}

.task-card {
    width: 700px;
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
