export interface User {
    token: string,
    username: string,
    avatar: string
}

export interface DataFromDb {
    status: Record<string, 0 | 1>,
    message: Record<string, string>,
    result: Record<any, any>
}

