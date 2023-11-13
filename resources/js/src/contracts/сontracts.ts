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

            // @ts-ignore
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

export function formatISO8601DateTime(date) {
    const year = date.getFullYear();

    // @ts-ignore
    const month = String(date.getMonth() + 1).padStart(2, '0');
    // @ts-ignore
    const day = String(date.getDate()).padStart(2, '0');
    // @ts-ignore
    const hours = String(date.getHours()).padStart(2, '0');
    // @ts-ignore
    const minutes = String(date.getMinutes()).padStart(2, '0');
    // @ts-ignore
    const seconds = String(date.getSeconds()).padStart(2, '0');

    return `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;
}

export const useTaskByIDQuery = () => useQuery("task_by_id", ()=>fetchTaskByID())
export const useCategoriesQuery = () => useQuery("categories", () => fetchData("categories"));
export const useTasksQuery = () => useQuery("tasks", () => fetchData("tasks"))

