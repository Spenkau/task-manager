import {defineStore} from "pinia";
import {reactive, ref} from "vue";

export const useUserStore = defineStore('user', () => {
    const user = ref({
        id:null,
        name:null,
        email:null,
        role_id:null,
        isAuth:null
    })

    return {user}
})
