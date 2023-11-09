

export type Categories = ICategory[]

export interface ICategory{
    id: number
    name: string
    slug: string
    parent_id: any
}

export type Tasks = ITask[]

export interface ITask {
    id: number
    title: string
    content: string
    category_id: number
    priority: number
    status: number
    parent_id: number | null
    started_at: string
    finished_at: string
    children: ITask[]
    tags: number[]
}

enum StatusTask {
    inactive ,
    active,
    pending ,
    performed
}
