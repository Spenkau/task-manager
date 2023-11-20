<template>
    <v-btn color="#CDE9FE" variant="outlined" @click="getTasksByTag">
        <i class="icon-tag"></i> <span class="tag-name">{{tag.name}}</span>
    </v-btn>
</template>

<script setup lang="ts">
import {computed, ref} from "vue";
import api from "../../dict/axios/api";
import {ITag} from "../../interfaces/interfaces";

const props = defineProps(['tag'])
const tag = ref(props.tag)

const getTasksByTag = () => {
    api.get(`tasks?tag=${tag.value.name}`).then(res => console.log(res))
}
</script>

<style scoped>
.icon-tag{
    margin-right: 10px;
}

.tag-name{
    color: hsl(206, 100%, 40%)
}
</style>
