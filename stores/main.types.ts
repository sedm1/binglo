export type User = {
    token: string,
    username: string,
    avatar: string
}

export type DataFromDb = {
    status: Record<string, 0 | 1>,
    message: Record<string, string>,
    result: Record<any, any>
}

