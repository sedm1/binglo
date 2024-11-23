import type { User } from "@/stores/main.types"

export type Board = {
    id: string,
    owners_id: string,
    title: string,
    description: string,
    types: string
} & User

export type Props = {
    boards: Board[],
    title: string
}