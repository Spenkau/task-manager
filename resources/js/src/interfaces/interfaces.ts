export interface ICategories {
    data: ICategory[]
}

export interface ICategory {
    id: number
    name: string
    slug: string
    parent_id: null | number
    created_at: string
    updated_at: string
    children: [] | ICategory[]
}


export interface ITasks {
    tasks: ITask[]
}

export interface ITask {
    id: number
    title: string
    content: string
    category_id: number
    priority_id: number
    status_id: number
    user_id: number
    parent_id?: number
    tag_id: any
    started_at: string
    finished_at: string
}
