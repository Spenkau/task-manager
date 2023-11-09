<template>
    <slot></slot>
    <div class="overlay__modal">
        <ul class="modal__list">
            <li>
                <a href="/user">
                    <i class="icon-user"> иконка личного кабинета </i>
                    Личный кабинет
                </a>
            </li>
            <li>
                <button>
                    <i class="icon-moon"> иконка смены цветового режима </i>
                    Темный режим
                </button>
            </li>
            <li>
                <button class="open-settings-modal">
                    <i class="icon-settings"> иконка настроек </i>
                    Настройки
                </button>
            </li>
            <li>
                <button>
                    <i class="icon-logout"> иконка выйти из аккаунты </i>
                    Выйти
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import {useUserStore} from "../../dict/store/store";
import {computed} from "vue";

const store = useUserStore()

const logout = computed(() => {
    store.user.isAuth = false
})

</script>

<style scoped lang="scss">
@import "../../../../css/general";

.overlay__modal {
    position: absolute;
    display: block;
    right: 200px;
    top: 100px;
    width: 200px;
    background-color: $white;
    padding: 25px 30px;
    border-radius: 10px;
    color: $black;
    z-index: 155;

}

.modal__list {
    font-size: 14px;

    li:not(li:last-child) {
        padding-bottom: 20px;
    }

    a, button {
        color: $black;
        display: flex;
        align-items: center;
        justify-content: left;
        gap: 5px;

        &:hover {
            color: $green;
        }
    }
}
</style>
