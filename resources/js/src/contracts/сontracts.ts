import {useQuery} from "vue-query";

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


export const useCategoriesQuery = () => useQuery("categories", () => fetchData("categories"));
export const useTasksQuery = () => useQuery("tasks", () => fetchData("tasks"))
