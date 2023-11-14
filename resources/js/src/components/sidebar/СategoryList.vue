<template>
    <ul class="sidebar__list">
        <li v-for="(categoryItem,key) in categoriesWithChildren" :key="key">
            <div class="category">
                <button @click="() => getTaskByCategory(categoryItem.slug)">
                    <i class="icon-category"></i>
                    {{ categoryItem.name }}
                    <i v-if="activeCategory" class="icon-active-category">иконка</i>
                </button>
            </div>
            <CategoryChildren
                v-if="!!categoryItem.children"
                :children="categoryItem.children"
            />
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
import {useUserStore} from "../../dict/store/store.js";
import {storeToRefs} from "pinia";

const store = useUserStore()
const activeCategory = ref(false)
const {tasks, categoriesWithChildren} = storeToRefs(store)


const getTaskByCategory = (slug) => {
    api.get(`/tasks/category/${slug}`).then(res => tasks.value = res.data.data)
}


</script>

<style scoped lang="scss">
@import "../../../../css/general";

.category{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.icon-active-category{
    @include icon(45px,10px, 'active_category')
}



.sidebar__list {
    padding-right: 7px;

    li {
        margin-bottom: 10px;
        i{
            width: 20px;
            height: 20px;
        }
        button {
            display: flex;
            align-items: center;
            border: none;
            background-color: transparent;
            cursor: pointer;
            font-size: 17px;
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
