<template>
    <RouterView/>
</template>

<script lang="ts">

console.log(import.meta.env.VITE_APP_NAME)
export default {
    name: 'App',
    created() {
      window.Echo.private('testchannel')
          .listen('Test', (e) => {
            console.log('test successful ' + e)
          })
    }
}
</script>

<style scoped lang="scss">

</style>
