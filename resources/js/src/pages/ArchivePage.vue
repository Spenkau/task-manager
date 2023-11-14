<template>
<div class="archive-page">
    <div class="archive-header">

        <span><RouterLink :to="'/user/'+username">Назад</RouterLink></span>
        <h1>Архив задач</h1>

    </div>
    <div class="search">
        <div class="search-input">
            <v-text-field
                label="Имя задачи"
            ></v-text-field>
        </div>
    </div>
    <div class="archive-body">
        <div>
            <div class="header-tasks">
                <h2>Задачи</h2>
                <v-select
                    label="Cортировать"
                    variant="solo-inverted"
                    :items="['По дате','Приоритету','Cтатусу','Не сортировать']"

                >

                </v-select>
            </div>
            <Suspense>
                <TaskList/>
                <template #fallback>
                    <p>
                        ожидание
                    </p>
                </template>
            </Suspense>
        </div>
        <div>
            <h2>Фильтр</h2>
            <div class="filter">
                <form>
                    <v-autocomplete
                        variant="outlined"
                        title="По категории"
                        :items="[1,2,3,4]"
                        color="#29a19c"
                        label="Категория"
                        clearable
                    ></v-autocomplete>
                    <v-autocomplete
                        variant="outlined"
                        title="По категории"
                        :items="[1,2,3,4]"
                        color="#29a19c"
                        label="Тег"
                        clearable
                    ></v-autocomplete>
                    <v-autocomplete
                        variant="outlined"
                        title="Приоритет"
                        :items="[1,2,3,4]"
                        color="#29a19c"
                        label="Приоритет"
                        clearable
                    ></v-autocomplete>
                    <v-btn type="submit" variant="tonal" color="#29a19c" text="Найти"/>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import {useRoute, useRouter} from "vue-router";
import {onMounted, ref} from "vue";
import api from "../dict/axios/api";
import TaskList from "../components/TaskList/TaskList.vue";



const route = useRoute();
const username = route.params.username
const router = useRouter()
const tasks = ref([])

onMounted(()=>{
    api.get('/tasks').then(res => tasks.value = res.data.data)
})

</script>

<style scoped lang="scss">
.header-tasks{
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 470px;
}

.archive-page{
    min-height: 100vh;
}

.archive-body{
    padding: 100px;
    display: flex;
    justify-content: center;
    gap: 50px;


}
.search{
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 80px;
    .search-input{
        width: 70%;
    }

}
.archive-header{
    display: flex;
    justify-content: center;
    padding-top: 30px;
    h1{
        font-size: 36px;
        font-weight: 700;
    }
    span{
        position: absolute;
        left: 30px;
        top: 30px;
    }
}

.filter{
    width: 300px;
    border: 1px solid rgba(41, 161, 156, 0.3);
    border-radius: 15px;
    padding: 30px;
    background-color: #FEFEFE;
}

</style>
