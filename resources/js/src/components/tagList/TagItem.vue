<template>
    <v-btn color="#CDE9FE" variant="outlined">
        <i class="icon-tag"></i> <span class="tag-name">{{tag.name}}</span>
    </v-btn>
</template>

<script setup lang="ts">
import {computed} from "vue";
import {ITag} from "../../interfaces/interfaces";

const props = defineProps(['tag'])
const tag = computed<ITag>(()=> props.tag)
</script>

<style scoped>
.icon-tag{
    margin-right: 10px;
}

.tag-name{
    color: hsl(206, 100%, 40%)
}
</style>
