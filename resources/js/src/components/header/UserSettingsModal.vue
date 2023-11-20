<template>
    <slot></slot>
    <div class="overlay__modal">
        <ul class="modal__list">
            <li>
                <RouterLink :to="'/user/'+ username">
                    <i class="icon-user"> иконка личного кабинета </i>
                    Личный кабинет
                </RouterLink>
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
                <button @click="logout">
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
import {useRouter} from "vue-router";

const router = useRouter()
const store = useUserStore()

const logout = computed(() => {
    store.user.isAuth = false
    localStorage.removeItem('access_token')
    router.push('/login')
})

const username = computed(() => {
    return store.user.name
})

</script>

<style scoped lang="scss">
@import "../../../../css/general";

.overlay__modal {
    position: absolute;
    display: block;
    right: 430px;
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
