<template>
    <div class="boards_list">
        <h2 class="boardsList_title">{{ title }}</h2>
        <div class="boardsList_list">
            <LazyBoardsItem
            v-for="boardItem in boards"
            :key="boardItem.id"
            :boardItem="boardItem"
            :color="colors[randomNumber(0, colors.length)]"
            />
            <button class="boards_empty">
                Создать новую доску 
            </button>
        </div>
    </div>
    
</template>
<script setup lang="ts">
import type { Props } from '@/components/interfaces/BoardsList.types'

const { boards, title } = defineProps<Props>()

const colors = ['gray', 'blue', 'purple', 'green', 'yellow']

const randomNumber = (min: number, max: number) => {
  return Math.floor(Math.random() * (max - min) + min);
}

</script>
<style lang="sass" scoped>
.boards 
    &_list 
        margin-bottom: 40px
    &List 
        &_list 
            display: flex
            gap: 40px
            margin-top: 10px
            align-items: flex-start
        &_title 
            font-size: 26px
            font-weight: 500
    &_empty
        max-width: 362px
        width: 100%
        display: flex
        align-items: center
        justify-content: center
        border: 1px dashed rgba(0,0,0,0.2)
        border-radius: 8px
        font-size: 16px
        font-weight: 400
        min-height: 144px
</style>