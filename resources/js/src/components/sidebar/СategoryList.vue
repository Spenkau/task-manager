<template>
    <ul class="sidebar__list">
        <li v-for="(categoryItem,key) in categories" :key="key">
            <v-icon color="primary" size="x-small" icon="mdi-check-circle"/>
            {{ categoryItem.name }}
            <CategoryChildren
                v-if="!!categoryItem.children"
                :children="categoryItem.children"
            />
        </li>
        <li class="list__new-category">
            <button type="button" @click="showModal = true">
                <i class="icon-square-plus">иконка добавить задачу</i>
                Добавить
            </button>
            <NewCategoryModal v-if="showModal">
                <div class="modal-category__overlay" @click="showModal = false"/>
            </NewCategoryModal>
        </li>
    </ul>
</template>

<script setup lang="ts">
import {computed, ref, toRefs} from "vue";
import CategoryChildren from "./CategoryChildren.vue";
import NewCategoryModal from "./NewCategoryModal.vue";


const props = defineProps(['categories'])
const showModal = ref(false)



</script>

<style scoped lang="scss">
@import "../../../../css/general";

.modal-category__overlay {
    display: block;
    position: fixed;
    background-color: rgb(40, 40, 70, .2);
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 6;
    font-size: 0;
}

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
