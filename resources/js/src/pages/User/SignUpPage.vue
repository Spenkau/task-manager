<template>
    <div class="signup-page">
        <v-card
            class="mx-auto"
            style="max-width: 500px;"
        >
            <v-toolbar
                cards
                color="#29a19c"
                flat
            >
                <RouterLink to="/main">
                    <v-btn icon>
                        <v-icon>mdi-arrow-left</v-icon>
                    </v-btn>
                </RouterLink>
                <v-card-title class="text-h6 font-weight-regular">
                    Регистрация
                </v-card-title>
                <RouterLink to="/signin" class="text-lg-h6 font-weight-regular">

                    У меня уже есть аккаунт
                </RouterLink>
            </v-toolbar>
            <v-form
                class="pa-4 pt-6"
                id="user"

            >
                <v-text-field
                    type="text"
                    v-model="name"
                    variant="filled"
                    color="#29a19c"
                    label="Логин"
                    required
                    @input="validateLogin"
                ></v-text-field>
                <v-text-field
                    type="tel"
                    v-model="phone"
                    variant="filled"
                    color="#29a19c"
                    label="Телефон"
                    prefix="+"
                    required
                    @input="restrictToNumbers"
                ></v-text-field>
                <ul class="email">
                    <li>
                        <v-text-field
                            v-model="email"
                            name="email"
                            variant="filled"
                            color="#29a19c"
                            label="Email"
                            type="text"
                            required
                        ></v-text-field>
                    </li>
                    <li class="select" v-if="userEmail">
                        <v-select
                            v-model="selectedMail"
                            :items="['@gmail.com','@mail.ru', '@yandex.ru']"
                            variant="filled"
                            name="mail"
                        ></v-select>
                    </li>
                </ul>
                <v-text-field
                    v-model="password"
                    name="password"
                    variant="filled"
                    color="#29a19c"
                    label="Пароль"
                    style="min-height: 96px"
                    type="password"
                    required
                ></v-text-field>
                <p class="text-hint">{{ password.length }} символов</p>
                <v-text-field
                    v-model="confirmPassword"
                    variant="filled"
                    color="#29a19c"
                    label="Повторите пароль"
                    style="min-height: 96px"
                    type="password"
                    required
                ></v-text-field>
                <p class="text-hint">{{ confirmPassword.length }} символов</p>
                <v-checkbox
                    v-model="agreement"
                >
                    <template v-slot:label>
                        <span style="font-size: 10px">
                            Я согласен c&nbsp;
                        <a
                            href="#"
                            @click.stop.prevent="dialog = true"
                        >Условиями предоставления услуг</a>
                        &nbsp;и&nbsp;
                        <a
                            href="#"
                            @click.stop.prevent="dialog = true"
                        > Политикой конфиденциальности</a>*
                        </span>
                    </template>
                </v-checkbox>
                <v-card-actions>
                    <v-btn
                        variant="text"
                        text="Очистить"
                        @click.prevent="clearForm"
                    />
                    <v-spacer v-if="errorMessage">{{ errorMessage }}</v-spacer>
                    <v-btn
                        :disabled="!isConfirmForm"
                        type="submit"
                        color="#29a19c"
                        text="Отправить"
                        @click.prevent="createUser"
                    />
                </v-card-actions>
            </v-form>
            <v-dialog
                v-model="dialog"
                max-width="400"
                persistent
            >
                <v-card>
                    <v-card-title class="text-h5 bg-grey-lighten-3">
                        Описание
                    </v-card-title>
                    <v-card-text>
                        Флажок «Согласие на обработку персональных данных» рядом с формами тоже обязателен. Согласно
                        закону, собирать и обрабатывать информацию о пользователях можно только с их согласия, за
                        исключением нескольких случаев, которые к сайтам не относятся. Более того, в случае проверки
                        владелец ресурса должен иметь возможность доказать, что согласие было.
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-btn
                            variant="text"
                            @click="agreement = false, dialog = false"
                        >
                            Не согласен
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="#29a19c"
                            @click="agreement = true, dialog = false"
                        >
                            Согласен
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card>
    </div>
</template>

<script setup>

import {computed, ref} from "vue";
import {formDataToJSON} from "../../contracts/сontracts";
import axios from "axios";


const dialog = ref(false);
const agreement = ref(false);
const password = ref("");
const confirmPassword = ref("")
const selectedMail = ref("@gmail.com")
const email = ref('')
const name = ref('')
const phone = ref('')
const errorMessage = ref('')

const isConfirmForm = computed(() => {
    return name.value !== '' &&
        phone.value !== '' &&
        email.value !== '' &&
        password.value !== '' &&
        agreement.value === true &&
        password.value === confirmPassword.value;
})

const userEmail = computed(() => {
    return ![...email.value].includes('@')
})

const validField = (field) => {
    return field.value === field.value.trim()
}

const restrictToNumbers = (e) => {

    phone.value = e.target.value.replace(/[^0-9]/g, '');
}

const validateLogin = () => {

    const regex = /^[A-Za-z0-9_]+$/;

    if (!regex.test(name.value)) {

        name.value = name.value.replace(/[^A-Za-z0-9_]/g, '');
    }
}

const clearForm = () => {
    name.value = ""
    email.value = ""
    phone.value = ""
    password.value = ""
    confirmPassword.value = ""
}

const createUser = () => {
    try {
        if (
            validField(name) &&
            validField(email) &&
            validField(phone) &&
            validField(password)
        ) {
            const jsonData = JSON.stringify({
                name: name.value,
                email: userEmail ? `${email.value}${selectedMail.value}` : email.value,
                phone: phone.value,
                password: password.value
            })

            console.log(jsonData)

            axios.post('user/register', jsonData)
                .then(res => res.data)
                .catch(e => console.error(e))

        } else {
            errorMessage.value = 'Поля не должны содержать пробелы!'
        }

    } catch (e) {
        console.log(`ошибка формы ${e}`)
    }


};
</script>


<style scoped lang="scss">
@import "../../../../css/general";

.email {
    display: flex;
    gap: 15px;
    align-items: center;

    li {
        width: 100%;
    }

    .select {
        width: 60%;
    }


}

.signup-page {
    position: fixed;
    width: 100%;
    height: 100%;
    display: flex;
    justify-items: center;
    align-items: center;

    .v-card-actions {
        justify-content: space-between;
    }

}


</style>
