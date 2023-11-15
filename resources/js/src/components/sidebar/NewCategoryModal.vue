<template>
    <button type="button" @click="showModal = true">
        <i class="icon-square-plus">иконка добавить задачу</i>
        <span>Добавить</span>
    </button>
    <v-dialog class="overlay" v-model="showModal">
        <div class="modal">
            <form id="category" class="decor">
                <div class="form-left-decoration"></div>
                <div class="form-right-decoration"></div>
                <div class="circle"></div>
                <div class="form-inner">
                    <h3>Создать категорию</h3>
                    <div>
                        <v-text-field
                            v-model="category"
                            label="Название категории..."
                            variant="solo-filled"
                            clearable
                        />
                        <v-select
                            v-model="selectedParent"
                            :items="categoriesSelect"
                            label="К какой категории относиться?"
                            clearable
                            item-value="value"
                            item-title="title"
                            @click.stop
                        />

                    </div>
                    <v-btn width="100%" type="submit" text="Отправить" color="#29a19c" @click="createCategory"></v-btn>
                </div>
            </form>
        </div>
    </v-dialog>
</template>

<script setup lang="ts">
import {computed, ref} from "vue";
import api from '../../dict/axios/api';
import {useUserStore} from "../../dict/store/store.js";
import {storeToRefs} from "pinia";

const category = ref('')
const showModal = ref(false)
const store = useUserStore()
const activeCategory = ref(false)
const {tasks, categories} = storeToRefs(store)
const categoriesSelect = categories.value
    .map((category) => {
        return {
            title: category.name,
            value: category.id
        }
    })

const selectedParent = ref('')
const createCategory = () => {
    api.post('/categories/store', {name: category.value, parent_id: selectedParent.value}).then(res => res.data)
}
</script>

<style scoped lang="scss">

@import "../../../../css/general";
.modal{
    position: fixed;
    left: 50%;
    top:50%;
    transform: translate(-50%,-50%);
}

.modal-category_container {
    form {
        background-color: $white;
        border-radius: 15px;
    }
}


.decor {
    width: 60vh;
    position: relative;
    background: white;
    border-radius: 30px;
}

.form-left-decoration, .form-right-decoration {
    content: "";
    position: absolute;
    width: 50px;
    height: 20px;
    background: rgb(143, 143, 147);
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
    background: white;
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

.list__new-category {
    margin-top: 30px;

    button {
        display: flex;
        gap: 5px;
        align-items: center;
        color: $green;
    }
}

.icon-category {
    @include icon(5px, 5px, "category")
}

.icon-square-plus {
    @include icon(20px, 20px, "square-plus");
}

</style>
