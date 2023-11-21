import axios from "axios";
import {useRouter} from "vue-router";
const router = useRouter()


const api = axios.create()

api.defaults.baseURL = "http://127.0.0.1:8000/api/auth/"

api.interceptors.request.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.Accept = 'application/json'
        config.headers["Content-Type"] = 'application/json'
        config.headers.Authorization = `Bearer ${localStorage.getItem('access_token')}`
    }
    return config
}, error => {
    if (error.response.status === 401){
        router.push('/login')
    }
})


api.interceptors.response.use({}, error => {
    console.log("моя ошибка" ,error)
    if(error.response.data.message === 'Token has expired'){
        axios.post('/api/auth/refresh',{}, {
            headers:{
                "Authorization": `Bearer ${localStorage.getItem('access_token')}`
            }
        }).then(res => {
            localStorage.setItem('access_token', res.data.access_token)

            error.config.headers.Authorization = `Bearer ${res.data.access_token}`

            return api.request(error.config)
        })
    }
})

export default api
