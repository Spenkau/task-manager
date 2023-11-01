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
            </v-toolbar>
            <form
                class="pa-4 pt-6"
                id="user"
                method="post"
                @submit.prevent="createUser"
            >
                <v-text-field
                    type="text"
                    name="login"
                    variant="filled"
                    color="#29a19c"
                    label="Логин"
                />

                <v-text-field
                    type="tel"
                    name="phone"
                    variant="filled"
                    color="#29a19c"
                    label="Телефон"
                />
                <v-text-field
                    name="email"
                    variant="filled"
                    color="#29a19c"
                    label="Email"
                    type="email"
                />
                <v-text-field
                    name="password"
                    variant="filled"
                    color="#29a19c"
                    counter="6"
                    label="Пароль"
                    style="min-height: 96px"
                    type="password"
                />
                <v-text-field
                    variant="filled"
                    color="#29a19c"
                    counter="6"
                    label="Повторите пароль"
                    style="min-height: 96px"
                    type="password"
                />
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
                    />
                    <v-spacer></v-spacer>
                    <v-btn
                        type="submit"
                        color="#29a19c"
                        text="Отправить"

                    />
                </v-card-actions>
            </form>
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

<script setup lang="ts">

import {ref} from "vue";
import {formDataToJSON} from "../../contracts/сontracts";

const dialog = ref(false);
const agreement = ref(false);


const createUser = () => {
    try{
        const formData = ref(new FormData(document.getElementById("user") as HTMLFormElement));
        console.log(formData.value)
    } catch (e){
        console.log(`ошибка формы ${e}`)
    }


};
</script>


<style scoped lang="scss">
@import "../../../../css/general";


.signup-page {
    position: fixed;
    width: 100%;
    height: 100%;
    display: flex;
    justify-items: center;
    align-items: center;

    .bg-deep-purple-accent-4 {

    }

    .text-deep-purple {
        color: $green !important;
    }

}


</style>
