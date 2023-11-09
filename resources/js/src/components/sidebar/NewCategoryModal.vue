<template>
    <slot></slot>
    <div class="modal-category_container" >
        <form id="category" class="decor" method="POST">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h3>Создать категорию</h3>
            <div>
                <v-select
                    clearable
                    label="Категория"
                    :items="[]"
                    variant="outlined"
                    name="category_id"
                ></v-select>
                <v-text-field
                    type="text"
                    label="Название категории..."
                    name="name"
                    variant="solo-filled"
                    :rules="rules"
                    clearable
                />
            </div>
            <input type="submit" value="Отправить">
        </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import {ref} from "vue";

    const rules = ref( [
        value => !!value || 'Required.',
        value => (value && value.length >= 3) || 'Min 3 characters',
    ])

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
