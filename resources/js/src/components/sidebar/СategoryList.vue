<template>
    <ul class="sidebar__list">
        <li v-for="(categoryItem,key) in categoryList" :key="key">
            <v-icon color="primary" size="x-small" icon="mdi-check-circle"/>
            {{ categoryItem.name }}
            <CategoryChildren
                v-if="!!categoryItem.children"
                :children="categoryItem.children"
            />
        </li>
        <li class="list__new-category">
            <button type="button">
                <i class="icon-square-plus">иконка добавить задачу</i>
                Добавить
            </button>
        </li>
    </ul>
</template>

<script lang="ts">
import {ICategories} from "../../interfaces/interfaces";
import {computed, ref, toRefs} from "vue";
import CategoryChildren from "./CategoryChildren.vue";

export default {
    name: "CategoryList",
    components: {CategoryChildren},
    props: {
        categories: Array
    },

    setup(props) {
        const {categories} = toRefs(props)

        const categoryList = ref<ICategories>(categories.value)


        return {
            categoryList
        }
    }
}

</script>

<style scoped lang="scss">
@import "../../../../css/general";

.sidebar__list {
    padding-right: 7px;

    li {
        margin-bottom: 10px;
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

    .list__new-category {
        margin-top: 30px;

        button {
            color: $green;
        }
    }

    .icon-category {
        @include icon(5px, 5px, "category")
    }

    .icon-square-plus {
        @include icon(20px, 20px, "square-plus");
    }
}
</style>
