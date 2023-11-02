<template>
    <div class="login-page">
        <v-form>

        </v-form>
    </div>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; width: 100vw">
        <input type="text" v-model="name" placeholder="nик_nамe" style="border: 1px solid black">
        <input type="text" v-model="password" placeholder="parol" style="border: 1px solid black">
        <input type="submit" value="vhod" style="background-color: black; color: white;">
    </div>
</template>

<script lang="ts">
import {ref} from 'vue';

const name = ref('');
const password = ref('');

class Auth {
    constructor() {
    }

    public options = {
        headers: {
            'Content-Type': 'application/json',
        },
        method: 'POST',
        body: '',
    };

    public login() {
        fetch('http://127.0.0.1:8000/api/auth/login', this.options)
    }
}

const authEx = new Auth();
</script>

<style scoped lang="scss">
@import "../../../../css/general";

.login-page {
    display: flex;
    justify-items: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
}
</style>
