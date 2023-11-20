<template>
    <Transition name="fade">
        <div>
            <slot></slot>
            <div class="modal-task_container">
                <form id="task" class="decor" method="POST" @submit.prevent="submitForm">
                    <div class="form-left-decoration"></div>
                    <div class="form-right-decoration"></div>
                    <div class="circle"></div>
                    <div class="form-inner">
                        <h3>Создать Задачу</h3>
                        <div class="name-status-group">
                            <v-text-field
                                v-model="title"
                                type="text"
                                label="Название задачи..."
                                hide-details="auto"
                                variant="outlined"
                                clearable
                            ></v-text-field>
                            <v-select
                                v-model="prioritySelect"
                                clearable
                                label="Приоритет"
                                :items="[{title:'Низкий',value:1},{title:'Обычный',value:2}, {title:'Высокий',value:3}]"
                                variant="outlined"
                                item-title="title"
                                item-value="value"
                            >
                            </v-select>
                        </div>
                        <v-autocomplete
                            clearable
                            v-model="selectCategory"
                            label="Категория"
                            :items="categoriesItems"
                            variant="outlined"
                            item-title="title"
                            item-value="value"
                        >
                        </v-autocomplete>
                        <v-textarea
                            v-model="content"
                            type="text"
                            label="Описание задачи..."
                            hide-details="auto"
                            name="content"
                            variant="outlined"
                            clearable
                            class="textarea"
                        ></v-textarea>
                        <ul class="task-date">
                            <li>
                                <v-text-field
                                    v-model="startedAt"
                                    type="date"
                                    label="Дата начала"
                                    hide-details="auto"
                                    name="started_at"
                                    variant="outlined"
                                    :min="minStartDate"
                                    @input="validateDates"
                                    clearable
                                ></v-text-field>
                            </li>
                            <li>
                                <v-text-field
                                    v-model="finishedAt"
                                    type="date"
                                    label="Дата завершения"
                                    hide-details="auto"
                                    name="finished_at"
                                    variant="outlined"
                                    :min="minEndDate"
                                    @input="validateDates"
                                    clearable
                                ></v-text-field>
                            </li>
                        </ul>
                        <v-autocomplete
                            v-model="selectTag"
                            clearable
                            label="Выберите тег(необязательно)"
                            :items="tagsList"
                            variant="outlined"
                            name="tag"
                        ></v-autocomplete>
                        <v-dialog
                            v-model="dialog"
                            width="500"
                        >
                            <v-card>
                                <v-card-text>
                                    <v-text-field
                                        v-model="newTag"
                                        type="text"
                                        variant="outlined"
                                        label="Тег"
                                        clearable
                                    >
                                    </v-text-field>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn color="#29a19c" block @click="saveTag">Cохранить</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                        <div class="checkboxs">
                            <v-checkbox
                                label="Скрытая задача"
                            >
                            </v-checkbox>
                            <v-checkbox
                                label="Совместная задача"
                            ></v-checkbox>
                        </div>
                        <v-btn type="submit" block text="Отправить" color="#29a19c"/>
                    </div>
                </form>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import {computed, onMounted, ref, toRefs, watch} from 'vue';
import {formatISO8601DateTime, formDataToJSON} from "../../contracts/сontracts";
import api from '../../dict/axios/api'
import {useUserStore} from "../../dict/store/store";



const store = useUserStore()
const {tasks, categories, tags} = toRefs(store)

const userID = computed(() => {
    return store.user.id
})
const title = ref('')
const content = ref('')
const selectTag = ref('')
const dialog = ref(false)
const newTag = ref('')
const categoriesItems = ref([])
const selectCategory = ref('')
const prioritySelect = ref("")
const tagsList = ref([])
const props = defineProps(['parentID'])

const getCurrentDate = () => {
    const now = new Date();
    const year = now.getFullYear();
    const month = `${now.getMonth() + 1}`.padStart(2, '0');
    const day = `${now.getDate()}`.padStart(2, '0');
    return `${year}-${month}-${day}`;
};

const startedAt = ref('');
const finishedAt = ref('');
const minStartDate = ref(getCurrentDate());
const minEndDate = ref('');

const validateDates = () => {
    minEndDate.value = startedAt.value
    console.log(typeof minEndDate.value )
    console.log(minEndDate.value )
    if(finishedAt.value < startedAt.value) {
        finishedAt.value = startedAt.value
    }
};

watch(selectTag, () => {
    console.log(selectTag.value)
    if (selectTag.value === 'Создать тег') {
        dialog.value = true
        selectTag.value = ''
    }
})



onMounted(async () => {
    categoriesItems.value = categories.value.map(category => {
        return {
            title:category.name,
            value:category.id
        }
    })
    tags.value = await api.get('/tags').then(res => res.data)
    const tagsItems = tags.value.map(tag => {
        return {
            title:tag.name,
            value:tag.id
        }
    })
    tagsList.value = [...tagsItems, 'Создать тег']

})



const saveTag = () => {
    api.post('/tags/store', {name: newTag.value}).then(res => console.log(res))
    dialog.value = false
}

const submitForm = () => {
    const jsonData = {
        task:{
            title:title.value,
            category_id:selectCategory.value,
            content:content.value,
            started_at:startedAt.value,
            finished_at:finishedAt.value,
            priority_id:prioritySelect.value,
            status_id:1,
            owner_id:userID.value,
            parent_id:props.parentID
        },
        tags:selectTag.value?[selectTag.value]:[]
    };
    console.log(selectTag)
    api.post('tasks/store', jsonData).then(res => tasks.value.unshift(res.data.data))
}


</script>

<style lang="scss">
@import "../../../../css/general";

.checkboxs{
    display: flex;
    width: 100%;
    justify-content: center;
    height: 70px;
}

.select-value{
    display: flex;
    align-items: center;
    gap: 10px;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.textarea {
    margin-bottom: 30px;
}

.modal-task_container {
    form {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        min-width: 600px;
        background-color: $white;
        z-index: 155;
    }

    .form-right-decoration {
        top: 380px;
    }

    .form-left-decoration {
        bottom: 0;
        top: 60px;
    }

    .circle {
        bottom: 0;
        top: 80px;
    }
}

.decor {
    position: relative;
    max-width: 400px;
    background: white;
    border-radius: 30px;
}

.form-left-decoration, .form-right-decoration {
    content: "";
    position: absolute;
    width: 50px;
    height: 20px;
    background: #D0D0D6;
    border-radius: 20px;
}

.form-left-decoration {
    bottom: 60px;
    left: -30px;
}

.form-right-decoration {
    top: 590px;
    right: -30px;
}

.form-left-decoration:before, .form-left-decoration:after, .form-right-decoration:before, .form-right-decoration:after {
    content: "";
    position: absolute;
    width: 50px;
    height: 20px;
    border-radius: 30px;
    background: #FAFAFA;
}

.form-left-decoration:before {
    top: -20px;
}

.form-left-decoration:after {
    top: 20px;
    left: 10px;
}

.form-right-decoration:before {
    top: -20px;
    right: 0;
}

.form-right-decoration:after {
    top: 20px;
    right: 10px;
}

.circle {
    position: absolute;
    bottom: 80px;
    left: -55px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
}

.form-inner {
    padding: 50px;
}


.form-inner {
    input[type="submit"] {
        margin-top: 30px;
        background: $green;
        border-bottom: 4px solid #175d5a;
        color: white;
        font-size: 14px;

        &:hover {
            border-bottom: none;
            border-top: 4px solid #175d5a;
        }

        &:active {
            border-bottom: none;
            border-top: none;
            border-right: 4px solid #175d5a;
            border-left: 4px solid #175d5a;
        }
    }
}


.form-inner h3 {
    margin-top: 0;
    font-weight: 500;
    font-size: 24px;
    color: #707981;
    margin-bottom: 20px;
}

.radio-group {
    display: flex;
    width: 90%;

    label {
        white-space: nowrap;
    }

    margin-bottom: 15px;
}


.modal-category_disabled {
    display: none;
}

.modal-category_active {
    display: block;
}


.category-group {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;

    .selected-option {
        justify-content: left;
        padding-left: 40px;
    }

    .options li {
        justify-content: left;
        padding-left: 40px;
    }
}


.selected-option {
    font-family: 'Roboto', sans-serif;
    height: 100%;
    width: 100%;
    font-size: 14px;
    display: flex;
    gap: 15px;
    justify-content: center;
    align-items: center;
    color: $black;
}

.custom-select-active {
    border-radius: 20px 20px 0 0;
}

.options {
    display: block;
    list-style: none;
    padding: 0;
    margin: 0;
    position: absolute;
    font-size: 14px;
    border-top: none;
    border-radius: 0 0 4px 4px;
    background-color: #E9EFF6;
    width: 100%;
    z-index: 20;
    top: 40px;
    max-height: 240px;
    overflow-y: scroll;

    &::-webkit-scrollbar {
        width: 0;

    }
}


.options-category {
    height: 300px;
    overflow-y: scroll;
    border-radius: 15px;
    //border: 2px solid $black;
    box-shadow: 0 0 73px -27px rgb(33, 32, 33);
    border-right: none;

    ::-webkit-scrollbar-track {
        background: #E9EFF6;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #E9EFF6;
    }

    li {
        justify-content: center;
        gap: 10px;
    }
}

.name-status-group {
    display: flex;
    gap: 20px;
}

.task-date {
    display: flex;
    padding-bottom: 20px;
    text-align: center;
    justify-content: space-between;
    gap: 20px;
    li{
        width: 100%;
    }
}

</style>
