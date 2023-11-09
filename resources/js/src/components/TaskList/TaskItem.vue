<template>
    <div class="tasks-container">
        <div class="item-task">
            <div class="task-card">
                <div class="task-header">
                    <div>
                        <DeleteTaskButton :taskID="taskItem.id"/>
                    </div>
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
                        <span>{{ categoryNameByID }}</span>
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
                    <div class="complete">
                        <CompleteTaskButton :taskID="taskItem.id"/>
                    </div>
                </div>
                <div class="task-body">
                    <h3>
                        <RouterLink :to="'/task/' + taskItem.id" >{{ taskItem.title }}</RouterLink>
                    </h3>
                    <div>
                        <ul class="tag-list">
                            <li class="task-card-tag">
                                <i class="icon-tag">иконка тега</i>
                                <RouterLink to="/tags"><span>тег</span></RouterLink>
<!--                                {{ taskItem.tag_id }}-->
                            </li>
                            <li class="task-card-tag">
                                <i class="icon-tag">иконка тега</i>
                                <RouterLink to="/tags"><span>тег</span></RouterLink>
                                <!--                                {{ taskItem.tag_id }}-->
                            </li>
                            <li class="task-card-tag">
                                <i class="icon-tag">иконка тега</i>
                                <RouterLink to="/tags"><span>тег</span></RouterLink>
                                <!--                                {{ taskItem.tag_id }}-->
                            </li>
                        </ul>
                    </div>
                    <i :class="'icon-priority_'+ taskItem.priority">иконка приоритета</i>
                </div>
                <div class="task-footer">
                    <button><i class="icon-rewrite"></i> редактировать</button>
                    <button><i class="icon-share"></i> поделиться</button>
                    <button><i class="icon-postpone"></i> отложить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {ITask} from "../../interfaces/interfaces";
import {ref, toRefs, computed, reactive} from "vue";
import CompleteTaskButton from "./СompleteTaskButton.vue";
import DeleteTaskButton from "./DeleteTaskButton.vue";
import {useUserStore} from "../../dict/store/store";

const store = useUserStore()
const categories = store.categories


const task = defineProps(['task'])
const taskItem = computed(() => task.task as ITask);

const categoryNameByID = computed(()=>{
    return categories.value.find(category => category.id === taskItem.value.category_id).name
})





const dateIsNull = computed(() => {

    return taskItem.value.started_at === null && taskItem.value.finished_at === null
})


</script>

<style scoped lang="scss">
@import "../../../../css/general";

.tag-list{
    display: flex;
    gap: 15px;
}

.item-task {
    display: flex;
    position: relative;
    margin-bottom: 30px;
}

.task-card {
    width: 700px;
    padding: 20px;
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


@keyframes filling {
    0% {
        width: 0;
    }
    100% {
        width: 100%;
    }

}

.activate {
    display: flex;
}

.task-header {
    color: rgba(40, 40, 70, 0.3);
    display: flex;
    align-items: center;
    gap: 40px;
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
    i:first-child{
        width: 19px;
        height: 19px;
    }
}

.task-footer {
    display: flex;
    justify-content: space-around;

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
