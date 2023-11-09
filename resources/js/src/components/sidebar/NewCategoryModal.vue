<template>
    <slot></slot>
    <div class="modal-category_container" >
        <form id="category" class="decor" novalidate @submit.prevent="createCategory">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h3>Создать категорию</h3>
            <div>
                <v-text-field
                    v-model="category"
                    type="text"
                    label="Название категории..."
                    name="name"
                    variant="solo-filled"
                    :rules="rules"
                    clearable
                />
            </div>
            <v-btn width="100%" type="submit" text="Отправить" color="#29a19c"></v-btn>
        </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import {computed, ref} from "vue";
import api from '../../dict/axios/api'
const category = ref('')
const rules = ref( [
    value => !!value || 'Заполните!',
    value => (value && value.length >= 3) || 'Минимум 3 буквы!',
])

const createCategory = computed(()=>{
    api.post('/categories/store', {name:category.value}).then(res => res.data)
})
</script>

<style scoped lang="scss">

@import "../../../../css/general";

.modal-category_container {
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 7;

    form {
        min-width: 500px;
        background-color: $white;
        border-radius: 15px;
    }
}


.decor {
    position: relative;
    max-width: 400px;
    background: white;
    border-radius: 30px;
}

.form-left-decoration, .form-right-decoration {
    content: "";
    position: absolute;
    width: 50px;
    height: 20px;
    background: #D0D0D6;
    border-radius: 20px;
}

.form-left-decoration {
    bottom: 60px;
    left: -30px;
}

.form-right-decoration {
    top: 60px;
    right: -30px;
}

.form-left-decoration:before, .form-left-decoration:after, .form-right-decoration:before, .form-right-decoration:after {
    content: "";
    position: absolute;
    width: 50px;
    height: 20px;
    border-radius: 30px;
    background: #FAFAFA;
}

.form-left-decoration:before {
    top: -20px;
}

.form-left-decoration:after {
    top: 20px;
    left: 10px;
}

.form-right-decoration:before {
    top: -20px;
    right: 0;
}

.form-right-decoration:after {
    top: 20px;
    right: 10px;
}

.circle {
    position: absolute;
    bottom: 80px;
    left: -55px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
}

.form-inner {
    padding: 50px;
}

.form-inner {
    input[type="submit"] {
        width: 100%;
        margin-top: 15px;
        padding: 15px;
        background: $green;
        border-bottom: 4px solid #175d5a;
        color: white;
        font-size: 14px;

        &:hover {
            border-bottom: none;
            border-top: 4px solid #175d5a;
        }

        &:active {
            border-bottom: none;
            border-top: none;
            border-right: 4px solid #175d5a;
            border-left: 4px solid #175d5a;
        }
    }
}

</style>
