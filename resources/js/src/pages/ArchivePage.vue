<template>
<div>
    <div class="archive-header">
        <RouterLink :to="'/user/'+username">Назад</RouterLink>
        <h1>Архив задач</h1>
    </div>
</div>
</template>

<script setup>
import {useRoute, useRouter} from "vue-router";

const route = useRoute();
const username = route.params.username
const router = useRouter()
</script>

<style scoped lang="scss">

</style>
