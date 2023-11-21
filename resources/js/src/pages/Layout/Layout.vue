<template>
    <div>
        <RouterView/>
    </div>
</template>

<script setup>
import api from "../../dict/axios/api";
import {onMounted} from "vue";
import {useUserStore} from "../../dict/store/store";
import {storeToRefs} from "pinia";
import {fetchTaskByPage} from "../../contracts/сontracts";

const store = useUserStore()
const {user, tasks, categories, categoriesWithChildren, tags} = storeToRefs(store)

const getUser = () => {
    try {
        api.post('/me')
            .then(res => {
                if (res?.data?.name) {
                    user.value.id = res.data.id
                    user.value.name = res.data.name
                    user.value.email = res.data.email
                    user.value.phone = res.data.phone
                    user.value.role_id = res.data.role_id
                    user.value.isAuth = true
                }
                console.log(user.value)
            })



    } catch (e) {
        console.error("Что-то пошло не так: ", e)
    }
}

const getData = () => {
    try {
        fetchTaskByPage(1).then(res => tasks.value = res.data.data)
        api.get('/categories/with_children').then(res => categoriesWithChildren.value = res.data.data)
        api.get('/categories/all').then(res => categories.value = res.data.data)
        api.get('/tags').then(res => tags.value = res.data)
    } catch (e) {
        console.error('Ошибка получения данных: ', e);
    }
}

onMounted(() => {
    getUser()
    getData()
})

</script>

<style scoped>

</style>
