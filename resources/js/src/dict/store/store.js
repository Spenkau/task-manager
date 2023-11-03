import {defineStore} from "pinia";
import {reactive, ref} from "vue";

export const useUserStore = defineStore('user', () => {
    const user = reactive({
        name:"",
        email:"",
        phone:"",
        isAuth:false
    })

    return {user}
})
