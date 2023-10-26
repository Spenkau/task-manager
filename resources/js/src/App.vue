<template>
    <RouterView/>
</template>

<script lang="ts">
import { useQueryProvider } from "vue-query";

useQueryProvider();
export default {
    name: "App",
}
</script>

<style scoped lang="scss">

</style>
