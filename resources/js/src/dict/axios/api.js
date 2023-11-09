import axios from "axios";
import {useRouter} from "vue-router";
const router = useRouter()


const api = axios.create()

api.defaults.baseURL = "http://127.0.0.1:8000/api/auth/"

api.interceptors.request.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers = {
            'Content-Type': 'application/json',
            "authorization":`Bearer ${localStorage.getItem('access_token')}`
        }
    }
    return config
}, error => {
    if (error.response.status === 401){
        router.push('/login')
    }
})


api.interceptors.response.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers = {
            'Content-Type': 'application/json',
            "authorization":`Bearer ${localStorage.getItem('access_token')}`
        }
    }
    return config
}, error => {
        if (error.response.status === 401){
            router.push('/login')
        }

})

export default api
