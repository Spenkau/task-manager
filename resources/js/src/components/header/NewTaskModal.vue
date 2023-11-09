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
                                type="text"
                                label="Название задачи..."
                                hide-details="auto"
                                name="title"
                                variant="outlined"
                                clearable
                            ></v-text-field>
                            <v-select
                                v-model="prioritySelect"
                                clearable
                                label="Приоритет"
                                :items="['Низкий','Обычный', 'Высокий']"
                                variant="outlined"
                            ></v-select>
                            <input type="hidden" name="priority_id" :value="priority">
                        </div>
                        <v-autocomplete
                            clearable
                            v-model="selectCategory"
                            label="Категория"
                            :items="categoriesTitle"
                            variant="outlined"
                        >
                        </v-autocomplete>
                        <input type="hidden" name="category_id" :value="idSelectedCategory">

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
                        <v-autocomplete
                            v-model="selectTag"
                            clearable
                            label="Веберете тег(необезательно)"
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
                        <input type="hidden" name="status_id" value="1">
                        <input type="hidden" name="user_id" :value="userID">

                        <v-btn type="submit" variant="tonal" block text="Отправить"/>
                    </div>
                </form>
            </div>
        </div>
    </Transition>
</template>

<script setup lang="ts">
import {computed, onMounted, ref, watch} from 'vue';
import {formDataToJSON} from "../../contracts/сontracts";
import api from '../../dict/axios/api'
import {useUserStore} from "../../dict/store/store";



const store = useUserStore()
const categories = store.categories
const userID = computed(() => {
    return store.user.id
})

const selectTag = ref('')
const dialog = ref(false)
const newTag = ref('')
const categoriesTitle = ref([])
const selectCategory = ref('')
const idSelectedCategory = ref(0)
const prioritySelect = ref("")
const priority = ref(0)

const tags = ref([])
const tagsList = ref([])



watch(selectTag, () => {
    if (selectTag.value === 'Создать тег') {
        dialog.value = true
        selectTag.value = ''
    }
})

watch(prioritySelect, () => {
    if (prioritySelect.value === 'Низкий') {
        priority.value = 1
    } else if (prioritySelect.value === 'Обычный') {
        priority.value = 2
    } else {
        priority.value = 3
    }
})

watch(selectCategory, () => {
    categories.value.forEach(category => {
        if (category.name === selectCategory.value) {
            idSelectedCategory.value = category.id
        }
    })
})

onMounted(async () => {
    categoriesTitle.value = categories.value.map(category => category.name)
    tags.value = await api.get('/tags').then(res => res.data)
    const tagsTitle = tags.value.map(tag => tag.name)
    tagsList.value = [...tagsTitle, 'Создать тег']

})

const saveTag = () => {
    api.post('/tags/store', {name: newTag.value}).then(res => console.log(res))
    dialog.value = false
}




const submitForm = () => {
    const formData = ref(new FormData(document.getElementById("task") as HTMLFormElement));
    const jsonData = formDataToJSON(formData.value);
    console.log(jsonData)
    api.post('tasks/store', jsonData).then(res => console.log(res.data))
}


</script>

<style lang="scss">
@import "../../../../css/general";


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
    top: 60px;
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
    justify-content: space-around;
    padding-bottom: 20px;
    text-align: center;

    label {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    input {
        font-family: "Roboto", sans-serif;
        color: $black;
        opacity: 0.7;
    }
}

</style>
