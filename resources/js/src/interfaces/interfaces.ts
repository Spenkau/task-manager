export interface ICategories {
    data: Data
}

interface Data {
    with_children: WithChildren[]
    all_categories: AllCategory[]
}

export interface WithChildren {
    name: string
}

export interface AllCategory {
    name: string
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
    started_at: any
    finished_at: any
}
