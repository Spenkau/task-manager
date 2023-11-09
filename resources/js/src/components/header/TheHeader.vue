<template>
    <header>
        <div class="header">
            <template v-if="isAuth">
                <div class="header__buttons">
                    <button class="button__create-task" type="button" @click="newTaskModalShow = true">
                        <i class="icon-plus"> иконка плюса </i>
                        Новая задача
                    </button>
                    <Teleport to="#app">
                        <NewTaskModal v-if="newTaskModalShow">
                            <div class="overlay" @click="newTaskModalShow = false"/>
                        </NewTaskModal>
                    </Teleport>
                    <button class="button__change-color-mode"><i class="icon-moon"> Переключатель цветового режима </i>
                    </button>
                </div>
                <div class="header__container">
                    <slot></slot>
                    <p>Хорешего дня, <span> {{ name }} </span></p>
                    <button class="container-button" @click="userToolsModalShow = true">
                        <div>
                            <img src="images/avatar.png" width="45" height="45" alt="картинка пользователя">
                            <div class="container__layout-icon">
                                <i class="icon-arrow-down"> Отрыть панель опций </i>
                            </div>
                        </div>
                    </button>
                    <Teleport to="#app">
                        <UserSettingsModal v-if="userToolsModalShow">
                            <div class="overlay" @click="userToolsModalShow = false"/>
                        </UserSettingsModal>
                    </Teleport>
                </div>
                <div class="user-settings-modal disabled-settings">
                    <div class="container">
                        <div class="settings-buttons">
                            <button class="button-settings-1 active-settings-button">Настройки внешнего вида</button>
                            <button class="button-settings-2 disabled-settings-button">Настройки аккаунта</button>
                        </div>
                        <div class="settings-body">
                            <ul class="settings-ui ">
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    Скрыть/Показывать часы
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    Скрыть/Показывать наблюдение
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    Скрыть/Показывать график успеваимости
                                </li>
                            </ul>
                            <ul class="settings-profile disabled-settings">
                                <li><a href="#">Изменить пароль</a></li>
                                <li><a href="#">Изменить почту</a></li>
                                <li><a href="#">Удалить аккаунт</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <nav class="header-nav">
                    <RouterLink to="/login">
                        <v-btn>
                            Войти
                        </v-btn>
                    </RouterLink>
                    <RouterLink to="/signup">
                        <v-btn prepend-icon="mdi-arrow-up-bold-box-outline" color="#29a19c">
                            Создать аккаунт
                        </v-btn>
                    </RouterLink>
                </nav>
            </template>
        </div>
    </header>
</template>

<script setup>
import NewTaskModal from "./NewTaskModal.vue";
import UserSettingsModal from "./UserSettingsModal.vue";
import {computed, ref} from "vue";
import {useUserStore} from "../../dict/store/store";


const store = useUserStore()
const isAuth = computed(() => {
    return store.user.isAuth
})


const name = computed(()=>{
    if (isAuth.value) {
        return store.user.name
    }
})



const newTaskModalShow = ref(false);
const userToolsModalShow = ref(false);


</script>

<style scoped lang="scss">
@import "../../../../css/general";

.header-nav {
    display: flex;
    align-items: center;
    gap: 120px;
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

.icon-plus {
    @include icon(15px, 15px, "plus");
}

.header {
    display: flex;
    min-height: 100px;
    justify-content: center;
    gap: 250px;
}

.header__buttons {
    display: flex;
    align-items: center;
    gap: 250px;
}

.button__create-task {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px;
    border-radius: 5px;
    background-color: $green;
    gap: 5px;
    color: $white;
    cursor: pointer;
    border: 1px solid transparent;
    transition: 200ms ease-in-out;
    font-size: 16px;

    &:hover {
        box-shadow: inset 0 0 73px -27px rgba(33, 32, 33, 1);
    }
}

.header__container {
    display: flex;
    align-items: center;
    gap: 30px;

    p {
        font-size: 18px;
    }
}

.button__change-color-mode {
    background-color: transparent;
    border: none;
    cursor: pointer;

    .icon-moon {
        @include icon(24px, 24px, "moon")
    }

    .icon-sun {
        @include icon(24px, 24px, "sun")
    }
}

.icon-arrow-down {
    @include icon(15px, 10px, "arrow-down")
}


.container-button {
    display: flex;
    border: none;
    background-color: transparent;
    cursor: pointer;

    div {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .container__layout-icon {
        background-color: $abs-white;
        border-radius: 50%;
        box-shadow: 0 0 73px -27px rgba(33, 32, 33, 1);
        padding: 7px;
    }

}


.icon-auth {
    @include icon(17px, 20px, "logout");
}


.icon-reg {
    @include icon(25px, 25px, "reg");
}

.header__auth-buttons {
    display: flex;
    align-items: center;

    a {
        display: flex;
        align-items: center;
        gap: 10px;
        color: $green;
        margin-right: 45px;
    }
}


.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 25px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 15px;
    width: 15px;
    left: 4px;
    bottom: 5px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
    background-color: $green;
}

input:focus + .slider {
    box-shadow: 0 0 1px $green;
}

input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}


.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}

.user-settings-modal {
    display: block;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(40, 40, 70, .2);
    z-index: 15;
}

.container {
    display: flex;
    width: 450px;
    height: 190px;
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background-color: #d5e7e7;
    z-index: 15;
    border-radius: 0;
}

.settings-body {
    display: flex;
    justify-items: center;
    align-items: center;
}


.settings-buttons {
    button {
        padding: 10px;
        font-size: 14px;
        position: absolute;

        &:first-child {
            margin-right: -5px;
        }
    }
}

.button-settings-1 {
    left: -112px;
    top: 77px;
    transform: rotate(90deg);
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}

.button-settings-2 {
    transform: rotate(90deg);
    right: -92px;
    width: 190px;
    top: 77px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}


.disabled-settings-button {
    background-color: $green;
    color: $white;
}

.active-settings-button {
    background-color: $white;
}

.settings-ui, .settings-profile {
    padding: 20px;

    li {
        display: flex;
        align-items: center;
        margin-bottom: 18px;

        &:last-child {
            margin-bottom: 0;
        }
    }
}

.settings-ui {
    display: flex;
    flex-direction: column;

    li {
        display: flex;
        gap: 15px
    }
}

.settings-profile {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    color: $white;
    background-color: #17908b;
    height: 100%;
    width: 430px;

    a {
        display: flex;
        justify-content: center;
        border-radius: 15px;
        font-size: 18px;
        width: 410px;
        padding: 12px;

        &:hover {
            box-shadow: inset 0 0 73px -27px rgb(33, 32, 33);
        }
    }
}

.disabled-settings {
    display: none;
}
</style>
