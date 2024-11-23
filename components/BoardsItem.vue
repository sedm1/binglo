<template>
    <div 
    class="board_item"
    :class="{
        ['board_item-color_' + color]: true
    }"
    >
        <div class="boardItem_header">
            <h3 class="boardItem_title">{{ boardItem.title }}</h3>
            <p class="boardItem_descript">{{ boardItem.description }}</p>
        </div>
        <div class="boardItem_footer">
            <div
            class="boardItem_avatar"
            >
                <img 
                src='/server/avatars/avatar.jpg'
                alt="UserAvatar"
                />
            </div>
            <div class="boardItem_arrow"><img src="/icons/arrow-right.svg" alt="ArrowRight"></div>
        </div>
        
    </div>
</template>
<script setup lang="ts">
import type { Props } from '@/components/interfaces/BoardItem.types'

const { boardItem, color } = defineProps<Props>()
</script>
<style lang="sass" scoped>
.board
    &_item
        max-width: 362px
        width: 100%
        border-radius: 8px
        padding: 15px
        min-height: 144px
        display: flex
        flex-direction: column
        justify-content: space-between
        &-color 
            &_gray
                background: #F4F4F4
            &_blue
                background: #EEF7FB
            &_purple
                background: #F8F1FF
            &_green
                background: #EBFDF5
            &_yellow
                background: #FEF7EF
    &Item 
        &_title 
            font-size: 16px
            font-weight: 400
            margin-bottom: 4px
        &_descript
            opacity: 0.4
            font-weight: 300
            font-size: 13px
        &_arrow
            max-width: 20px
            width: 100%
            display: flex
        &_footer 
            display: flex 
            align-items: center
            justify-content: space-between
            margin-top: 20px
        &_avatar
            width: 30px
            border-radius: 100%
            overflow: hidden
            display: flex
            img 
                border-radius: 100%
</style>