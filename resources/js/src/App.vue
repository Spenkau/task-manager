<template>
    <RouterView/>
</template>

<script lang="ts">

console.log(import.meta.env.VITE_APP_NAME)
export default {
    name: 'App',
    mounted() {
        console.log('e');
        // to connect the public channel
        window.Echo.channel('public').listen('Hello', (e) => {
            console.log('go public');
            //code for displaying the serve data
            console.log(e); // the data from the server
        })
    }
}
</script>

<style scoped lang="scss">

</style>
