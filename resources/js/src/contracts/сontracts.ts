import {useQuery} from "vue-query";
import api from "../dict/axios/api"
import {useRouter} from "vue-router";
const router = useRouter()

const fetchData = async (data: string) => {
    try {
        const res = await fetch(`http://127.0.0.1:8000/api/${data}`, {method: "GET"});
        if (res.ok) {
            return await res.json()
        }
    } catch (e) {
        console.error('Ошибка получения данных:', e);
    }
}

export const fetchTaskByID = async (ID = "") => {
    try {
        const res = await api.get(`tasks/${ID}`);
        if (res.data) {
            return await res.data
        }
        if (res.status === 404) {
            router.push("/404")
        }
    } catch (e) {
        console.error('Ошибка получения данных', e)
    }
}

export const fetchTaskByPage = async (page:number|string) => {
    try {
        const res = await api.get(`tasks?page=${page}`);
        if (res.data) {
            return await res.data
        }
    } catch (e) {
        console.error('Ошибка получения данных', e)
    }

}

export const formDataToJSON = (formData) => {
    const jsonObject = {};
    formData.forEach((value, key) => {
        jsonObject[key] = value;
    });
    return JSON.stringify(jsonObject);
}

export const useTaskByIDQuery = () => useQuery("task_by_id", ()=>fetchTaskByID())
export const useCategoriesQuery = () => useQuery("categories", () => fetchData("categories"));
export const useTasksQuery = () => useQuery("tasks", () => fetchData("tasks"))

