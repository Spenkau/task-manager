<template>
    <slot>
        <div class="sidebar__logo">
            <img src="images/icons/logo.svg" alt="logo">
        </div>
        <h2>Категории</h2>
        <CategoryList/>
        <a class="logout" href="/signin"><i class="icon-logout">иконка выхода</i> Выйти</a>
    </slot>
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
    img{
        margin-top: 20px;
        width: 156px;
        height: 65px;
    }
}

.active-category {
    background: url("/public/images/icons/active.svg") right no-repeat;
}

.sidebar__list {
    padding-right: 20px;
    li {

        button {
            display: flex;
            align-items: center;
            border: none;
            background-color: transparent;
            cursor: pointer;
            font-size: 16px;
            gap: 5px;

        }
    }
}

</style>
