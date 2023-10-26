<template>
    <slot></slot>
    <div class="overlay__modal">
        <ul class="modal__list">
            <li>
                <a href="/profile">
                    <i class="icon-user"> иконка личного кабинета </i>
                    Личный кабинет
                </a>
            </li>
            <li>
                <a href="">
                    <i class="icon-moon"> иконка смены цветового режима </i>
                    Темный режим
                </a>
            </li>
            <li>
                <button class="open-settings-modal">
                    <i class="icon-settings"> иконка настроек </i>
                    Настройки
                </button>
            </li>
            <li>
                <a href="">
                    <i class="icon-logout"> иконка выйти из аккаунты </i>
                    Выйти
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
name: "UserSettingsModal"
}
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

.icon-user {
    @include icon(22px, 22px, "user")
}

.icon-moon {
    @include icon(20px, 20px, "moon")
}

.icon-settings {
    @include icon(20px, 20px, "settings")
}

.icon-logout {
    @include icon(17px, 20px, "logout")
}

.modal__list {
    font-size: 14px;

li:not(li:last-child) {
    padding-bottom: 20px;
}

a, button{
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
