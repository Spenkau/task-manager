<template>
<ul>
    <li v-for="(child,key) in childrenCategory" :key="key">
        <v-icon color="primary" size="x-small" icon="mdi-check-circle"/>
        <button @click="() => getTaskByCategory(child.slug)">{{child.name}}</button>
        <CategoryChildren
            v-if="!!child.children"
            :children="child.children"
        />
    </li>
</ul>
</template>

<script setup>
    import {ref} from "vue";
    import api from "../../dict/axios/api";
    import {useUserStore} from "../../dict/store/store";
    import {storeToRefs} from "pinia";

    const props = defineProps(['children'])
    const childrenCategory = ref(props.children)
    const store = useUserStore()
    const {tasks} = storeToRefs(store)

    const getTaskByCategory = (slug) => {
        api.get(`/tasks/category/${slug}`).then(res => tasks.value = res.data.data)
    }
</script>

<style lang="scss" scoped>
ul{
    padding-left: 20px;
    li{
        margin-top: 4px;
        margin-bottom: 4px;
    }
}
</style>
