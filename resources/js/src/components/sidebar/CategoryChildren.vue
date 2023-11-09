<template>
<ul>
    <li v-for="(child,key) in childrenCategory" :key="key">
        <v-icon color="primary" size="x-small" icon="mdi-check-circle"/>
        {{child.name}}
        <CategoryChildren
            v-if="!!child.children"
            :children="child.children"
        />
    </li>
</ul>
</template>

<script setup>
    import {ref} from "vue";

    const props = defineProps(['children'])
    const childrenCategory = ref(props.children)
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
