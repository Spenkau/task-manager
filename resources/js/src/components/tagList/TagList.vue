<template>
    <v-list>
        <v-list-item v-for="(tag,key) in tags" :key="key">
            <TagItem :tag="tag"/>
        </v-list-item>
    </v-list>
</template>

<script setup>
import api from "../../dict/axios/api";
import {onMounted, ref} from "vue";
import TagItem from "./TagItem.vue";

const tags = ref([])

onMounted(() => {
    api.get('/tags').then(res => tags.value = res.data)
    console.log(tags.value)
})

</script>

<style scoped lang="scss">
.v-list{
    background-color: transparent;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}
</style>
