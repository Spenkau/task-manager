<template>
    <div class="login-page">
        <v-card>
            <v-toolbar
                color="#29a19c"
                class="px-4 py-1"
            >
                <RouterLink to="/main">
                    <v-btn icon>
                        <v-icon>mdi-arrow-left</v-icon>
                    </v-btn>
                </RouterLink>
                <v-card-title class="text-h6 font-weight-regular">
                    Авторизация
                </v-card-title>
                <RouterLink to="/signup" class="text-lg-h6 font-weight-regular">
                    <v-card-title class="text-h6 font-weight-regular">
                        У меня нет аккаунта
                    </v-card-title>
                </RouterLink>
            </v-toolbar>
            <v-form
                class="pa-4 pt-6"
            >
                <v-text-field
                    type="text"
                    v-model="email"
                    name="name"
                    variant="filled"
                    color="#29a19c"
                    label="Почта"
                    required
                ></v-text-field>
                <v-text-field
                    type="password"
                    v-model="password"
                    name="password"
                    variant="filled"
                    color="#29a19c"
                    label="Пароль"
                    required
                ></v-text-field>
                <v-card-actions>
                    <v-spacer v-if="errorMessage">{{ errorMessage }}</v-spacer>
                    <v-btn type="submit" text="Отправить" @click.prevent="authUser"/>
                </v-card-actions>
            </v-form>
        </v-card>
    </div>
</template>

<script lang="ts" setup>
import {ref} from 'vue';
import axios from "axios";
import {useRouter} from "vue-router";

const router = useRouter()
const email = ref('');
const password = ref('');
const errorMessage = ref('')
import {useUserStore} from "../../dict/store/store";


const store = useUserStore()



const headers = {
    'Content-Type': 'application/json',
}


const authUser = () => {

    const jsonData = JSON.stringify({
        email: email.value,
        password: password.value
    })

    axios.post('api/auth/login', jsonData, {headers})
        .then(res => {
            if (res.data) {
                localStorage.setItem('access_token', res.data.access_token)
                store.user.name = email.value
                router.push('/main')
            }
        })
        .catch(e => {
            if (e?.response?.data?.error) {
                errorMessage.value = "Неверно введен пароль или логин"

            }
        })
}


</script>

<style scoped lang="scss">
@import "../../../../css/general";

.login-page {
    display: grid;
    align-items: center;
    justify-content: center;
    width: 100vw;
    height: 100vh;

    .v-card-actions {
        display: flex;
        justify-content: flex-end;
    }
}

a {
    color: white;
    text-decoration: none;
}

.v-spacer {
    color: #0b2e13;
}
</style>
