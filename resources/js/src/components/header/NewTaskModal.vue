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
                            <input type="text" placeholder="Название задачи..." name="title" class="custom_input"
                                   required>
                            <v-select
                                clearable
                                label="Приоритет"
                                :items="['Низский','Обычный', 'Высокий']"
                                variant="outlined"
                                name="priority"
                            ></v-select>
                        </div>

                        <v-select
                            clearable
                            label="Категория"
                            :items="['Дом', 'Работа', 'Дети', 'Фронт', 'Бек', 'Драка']"
                            variant="outlined"
                            name="category"
                        ></v-select>

                        <textarea placeholder="Описание задачи..." rows="3" name="content" class="custom_input"
                                  required></textarea>
                        <div class="task-date">
                            <label for="started_at">
                                Дата начала
                                <input type="datetime-local" min="2023-10-18" id="started_at" name="started_at"
                                       class="custom_input"
                                       required>
                            </label>
                            <label for="finished_at">
                                Дата завершения
                                <input type="datetime-local" id="finished_at" name="finished_at" class="custom_input"
                                       required>
                            </label>
                        </div>
<!--                        <input type="text" maxlength="16" name="tag" class="custom_input"-->
<!--                               placeholder="Введите тег задачи(необезательно)...">-->
                        <input type="submit" class="custom_input" value="Отправить">
                    </div>
                </form>
            </div>
        </div>
    </Transition>
</template>

<script setup lang="ts">
import {ref} from 'vue';



const submitForm = async () => {

    try {
        const formData = ref(new FormData(document.getElementById("task") as HTMLFormElement));
        const jsonData = formDataToJSON(formData.value);
        console.log(jsonData)
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: jsonData,
        };

        fetch('http://127.0.0.1:8000/api/tasks/store',options)
            .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка сети или сервера');
            }
            return response.json();
            })
            .then(data => {
                console.log('Ответ от сервера:', data);
            })
            .catch(error => {
                console.error('Произошла ошибка:', error);
            });
    } catch (e) {
        console.error('Ошибка формы', e);
    }
}

const formDataToJSON = (formData) => {
    const jsonObject = {};
    formData.forEach((value, key) => {
        jsonObject[key] = value;
    });
    return JSON.stringify(jsonObject);
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

.form-inner .custom_input {
    display: block;
    width: 100%;
    padding: 0 20px;
    background: #E9EFF6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    font-family: 'Roboto', sans-serif;
    margin-bottom: 25px;
    transition: .2s ease all;
    outline: 1px solid transparent;

    &:focus {
        outline: 1px solid $green;
    }

    &::placeholder {
        color: $black;
        opacity: 0.7;
    }
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


.form-inner textarea {
    &::placeholder {
        padding-top: 10px;
    }

    resize: none;
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


.icon-priority_high {
    @include icon(11px, 20px, 'priority_high')
}

.icon-priority_medium {
    @include icon(11px, 20px, 'priority_medium')
}

.icon-priority_low {
    @include icon(11px, 20px, 'priority_low')
}

.custom-select {
    position: relative;
    width: 200px;
    border-radius: 20px;
    cursor: pointer;
    background-color: #E9EFF6;
    height: 40px;

    .selected-option {
        padding-left: 0;
    }
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


.options li {
    display: flex;
    justify-content: center;
    gap: 15px;
    align-items: center;
    padding: 10px;

    &:hover {
        background-color: #f0f0f0;
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

.options_hidden {
    display: none;
}

.disabled-option {
    display: none;
}
</style>
