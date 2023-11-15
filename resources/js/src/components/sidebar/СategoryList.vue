<template>
    <ul class="sidebar__list">
        <li v-for="(categoryItem,key) in categoriesWithChildren" :key="key">
            <CategoryItem :category="categoryItem"/>
        </li>
        <li class="list__new-category">
            <NewCategoryModal />
        </li>
    </ul>
</template>

<script setup lang="ts">
import {computed, ref, toRefs} from "vue";
import CategoryChildren from "./CategoryChildren.vue";
import NewCategoryModal from "./NewCategoryModal.vue";
import api from "../../dict/axios/api.js"
import CategoryItem from "./CategoryItem.vue";
import {storeToRefs} from "pinia";
import {useUserStore} from "../../dict/store/store";
const store = useUserStore()
const {categoriesWithChildren} = storeToRefs(store)



</script>

<style scoped lang="scss">
@import "../../../../css/general";


.icon-active-category{
    @include icon(45px,10px, 'active_category')
}



.sidebar__list {
    padding-right: 7px;


    .list__new-category {
        margin-top: 30px;

        button {
            color: $green;
        }
    }

    .icon-square-plus {
        @include icon(20px, 20px, "square-plus");
    }
}
</style>
