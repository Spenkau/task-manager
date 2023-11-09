<template>
  <h1>TEST PAGE</h1>


    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; width: 100vw">
        <input type="text" v-model="name" placeholder="nик_nамe" style="border: 1px solid black">
        <input type="text" v-model="password" placeholder="parol" style="border: 1px solid black">
        <input
            type="submit"
            value="vhod"
            @click.prevent="login"
            style="background-color: black; color: white;">
    </div>
</template>

<script>
import {ref} from 'vue';

const name = ref('');
const password = ref('');


const jsonData = JSON.stringify({
    name: name.value,
    password: password.value
})

const options = {
    headers: {
        'Content-Type': 'application/json',
    },
    method: 'POST',
    body: jsonData,
};

const login = () => {
    fetch('http://127.0.0.1:8000/api/auth/login', this.options)
        .then(res => console.log('res', res))
}
</script>

<style scoped>

</style>
