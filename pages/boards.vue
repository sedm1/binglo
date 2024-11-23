<template>
    <main>
        <section class="boards">
            <div class="container">
                <LazyBoardsList
                v-for="(boardsListItem, index) in sortedBoardsList"
                :boards="boardsListItem.value"
                :title="titles[index]"
                />
            </div>
        </section>
        
    </main>
</template>
<script lang="ts" setup>
import type { Board } from "@/components/interfaces/BoardsList.types";
import type { DataFromDb } from "@/stores/main.types";

useHead({
    title: 'Все доски - Binglo'
})

const config = useRuntimeConfig()
const mainStore = useMainStore()

const boardsList: Ref<Board[]> = ref([])

const titles = ['Новые', 'В процессе', 'Завершенные']
/**
 * "Новые" доски
 */
const newBoardsList = computed(() => {
    return boardsList.value.filter((boardItem) => boardItem.types === '1')
})

/**
 * "В процессе" доски
 */
const inProccesBoardsList = computed(() => {
    return boardsList.value.filter((boardItem) => boardItem.types === '2')
})

/**
 * "Завершенные" доски
 */
const endedBoardsList = computed(() => {
    return boardsList.value.filter((boardItem) => boardItem.types === '3')
})

const sortedBoardsList = computed(() => {
    return [newBoardsList, inProccesBoardsList, endedBoardsList]
})
/**
 * Получение досок
 */
const getBoards = async () => {
    try {
        await useFetch(config.public.BD + 'boards.php', {
            method: 'GET',
            query: {
                q: 'getBoards',
                token: mainStore.user.token
            }
        })
        .then((res) => {
            const result = res.data.value as unknown as DataFromDb

            boardsList.value = result.result as Array<Board>
        })
        .catch((err) => {
            console.log('Ошибка при получении досок: ' + err)
            return;
        })
    } catch {
        console.log('Ошибка при получении досок')
        return;
    }
}
getBoards()
</script>
<style lang="sass" scoped>
.boards
    margin-top: 20px
</style>
