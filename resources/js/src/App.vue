<template>
    <RouterView/>
</template>

<script lang="ts">
export default {
    name: "App",
}
</script>

<style scoped lang="scss">
    .active-page{
        background-color: #1a202c;
        color: whitesmoke;
    }

    .slide-fade-enter-active {
        transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
        transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
        transform: translateX(20px);
        opacity: 0;
    }
</style>
