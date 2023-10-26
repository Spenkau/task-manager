<template>
    <div class="sidebar">
        <div class="sidebar__logo">
            <img src="images/icons/logo.svg" alt="logo">
        </div>
        <h2>Категории</h2>
        <slot></slot>
        <a class="logout" href="/signin"><i class="icon-logout">иконка выхода</i> Выйти</a>
    </div>
</template>

<script>
import CategoryList from "./СategoryList.vue";

export default {
    name: "Sidebar",
    components: {CategoryList},
}
</script>

<style scoped lang="scss">
@import "../../../../css/general";

.sidebar {
    background-color: $abs-white;
    min-width: 300px;
    padding: 20px 0 20px 20px;
    transition: left 350ms ease;
    position: fixed;
    z-index: 5;
    top: 0;
    left: 0;
    height: 100%;
    overflow-y: scroll;

    &::-webkit-scrollbar {
        width: 0;
    }

    h2 {
        color: $green;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 30px;
        line-height: 26px;
    }

    a {
        display: flex;
        margin-top: 100%;
        align-items: center;
        gap: 5px;
        color: $black;

        i {
            transform: rotate(180deg);
        }
    }
}

.sidebar__logo {
    margin-bottom: 50px;
    display: flex;
    align-items: center;

    img {
        margin-top: 20px;
        width: 156px;
        height: 65px;
    }
}

.active-category {
    background: url("/public/images/icons/active.svg") right no-repeat;
}



</style>
