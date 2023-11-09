import {defineStore} from "pinia";
import {reactive, ref} from "vue";
import {Categories, Tasks} from "../../interfaces/interfaces";


export const useUserStore = defineStore('user', () => {
    const user = ref({
        id:null,
        name:null,
        email:null,
        role_id:null,
        isAuth:null
    })
    const tasks = ref<Tasks | []>([])

    const categories = ref<Categories | []>([])
    const categoriesWithChildren = ref([])

    return {user,tasks,categories,categoriesWithChildren}
})
