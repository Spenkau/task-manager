<template>
<div class="tags-page">
    <div class="link-back">
        <RouterLink to="/">Вернуться назад</RouterLink>
    </div>
    <div class="tags-page-header">
        <h2>Поиск по вашим тегам</h2>
        <v-text-field
            label="Поиск"
            prepend-icon="$vuetify"
            variant="underlined"
        ></v-text-field>
        <div class="tag-list">
            <TagList/>
        </div>
        <v-list>
            <v-list-item v-for="(task,key) in tasks" :key="key">
                <MiniTaskCard :task="task"/>
            </v-list-item>
        </v-list>
    </div>
</div>
</template>

<script setup lang="ts">
import TagList from "../components/tagList/TagList.vue";
import MiniTaskCard from "../components/widgets/MiniTaskCard.vue";
import {useUserStore} from "../dict/store/store";
import {onMounted, ref} from "vue";
import api from "../dict/axios/api"
const tasks = ref([])


onMounted(()=>{
    api.get('/tasks').then(res => tasks.value = res.data )
})
</script>

<style scoped lang="scss">
@import "../../../css/general";


.link-back{
    left: 20px;
    top:30px;
    position: absolute;
}

.tags-page{
    display: flex;
    justify-content: center;
    background:$white url("/public/images/bg/figure.svg") repeat 260px 760px;
    min-height: 100vh;
    min-width: 100vw;
    padding-top: 80px;
    padding-bottom: 80px;
h2{
    text-align: center;
    font-size: 50px;
    font-weight: 700;
    margin-bottom: 50px;
}
}

.tags-page-header{
    width: 800px;
}

.v-list{
    background-color: transparent;
    display: flex;
    flex-wrap: wrap;
}

.tag-list{
    margin-bottom: 30px;
}
</style>
