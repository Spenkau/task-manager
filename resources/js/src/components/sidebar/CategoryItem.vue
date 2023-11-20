<template>
    <div class="category" v-if="category" :class="activeCategory.id === category.id && 'active'">
        <button @click="getTaskByCategory">
            <i class="icon-category">иконка категории</i>
            {{ category.name }}
            <i v-if="activeCategory === category.id" class="icon-category_active">иконка категории</i>
        </button>
        <ul v-if="!!category.children" class="category-child-list">
            <li v-for="(category,key) in category.children" :key="key" class="child-item">
                <CategoryItem :category="category"/>
            </li>
        </ul>
    </div>
</template>

<script setup>

import api from "../../dict/axios/api";
import {useUserStore} from "../../dict/store/store";
import {storeToRefs} from "pinia";
import {ref, watch} from "vue";


const props = defineProps(['category'])
const category = ref(props.category)
const store = useUserStore()
const {tasks,activeCategory} = storeToRefs(store)

const getTaskByCategory = () => {
 // ALEX
    if (activeCategory.value) {
        activeCategory.value = false;
        api.get('/nested_tasks').then((res) => {tasks.value = res.data.data})
    } else {
        activeCategory.value = true;
        api.get(`/task/category/${category.value.slug}`).then((res) => (tasks.value = res.data.data));
    }
    activeCategory.value = category.value.id
// ALEX
    api.get(`/tasks/category/${category.value.slug}`).then((res) => (tasks.value = res.data.data));

    // if (isActiveCategory.value) {
    //     activeCategory.value = null;
    //     api.get('/tasks').then((res) => {tasks.value = res.data.data})
    //     isActiveCategory.value = false
    // } else {
    //     activeCategory.value = category.id;
    //
    // }
}



</script>
<style scoped lang="scss">
@import "../../../../css/general";

.category-child-list{
    display: block;
    padding-left: 20px;
    .child-item{
        button{
            margin-bottom: 10px;
        }

    }
}

.category {
    margin-bottom: 10px;
    button {
        width: 100%;
        display: flex;
        align-items: center;
        border: none;
        //background-color: transparent;
        cursor: pointer;
        font-size: 17px;
        gap: 5px;
        margin-bottom: 10px;
        padding: 5px 8px;
        border-radius: 15px;
        justify-content: flex-start;

    }
}

.icon-category {
    @include icon(5px, 5px, "category")
}

.active{
    .icon-category_active{
        margin-left: auto;
    }
}
</style>
