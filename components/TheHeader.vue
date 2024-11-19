<template>
    <header>
        <ClientOnly>
            <div class="container">
                <div class="header_block">
                    <div class="header_left">
                        <div class="header_logo">Binglo</div>
                        <div class="header_line" v-if="mainStore.user.token"></div>
                        <NuxtLink to="/" class="headerLeft_link" v-if="mainStore.user.token">
                            <img src="/icons/graph.svg" alt="Graph" class="headerLeftLink_img">
                            <p class="headerLeftLink_title">Доски</p>
                        </NuxtLink>
                        <div class="header_line" v-if="mainStore.user.token"></div>
                        <form class="header_form" v-if="mainStore.user.token">
                            <input type="text" class="headerForm_input" placeholder="Введите название доски...">
                            <button class="headerForm_button"><img src="/icons/search.svg" alt="SearchButton"></button>
                        </form>
                    </div>
                    <div class="header_right" v-if="mainStore.user.token">
                        <div class="headerRight_actions">
                            <button class="headerRightActions_button"><img src="/icons/addIcon.svg"
                                    alt="AddIcon"></button>
                        </div>
                        <NuxtLink to="/" class="headerRight_avatar"><img src="/server/avatars/avatar.jpg"
                                alt="AvatarIcon"></NuxtLink>
                    </div>
                    <div class="header_right" v-else>
                        <NuxtLink class="headerRight_login" to="/login">Войти</NuxtLink>
                        <div class="header_line"></div>
                        <NuxtLink class="headerRight_reg" to="/registration">Зарегистрироваться</NuxtLink>
                    </div>
                </div>

            </div>
        </ClientOnly>

    </header>
</template>
<script setup lang="ts">
import { useMainStore } from '@/stores/main'
const mainStore = useMainStore()

mainStore.getUserInfo()

</script>
<style lang="sass" scoped>
header 
    border-bottom: 1px solid $gray 
    padding: 10px 0px
.header
    &_block 
        display: flex
        align-items: center
        justify-content: space-between
    &_left
        display: flex
        align-items: center
        gap: 20px
        max-width: 760px
        width: 100%
    &_line
        height: 40px
        background: $gray 
        width: 1px
        opacity: 0.5
    &_logo
        font-size: 30px
        font-weight: 700
    &Left
        &_link 
            display: flex
            align-items: center
            gap: 5px
        &Link 
            &_img 
                width: 24px
            &_title
                font-size: 16px
    &_form
        max-width: 512px
        width: 100%
        position: relative
        
    &Form 
        &_input 
            width: 100%
            border-radius: 30px
            background: $whiteGray
            height: 30px
            padding-left: 20px
            font-size: 14px
        &_button
            position: absolute
            top: 50%
            transform: translateY(-7px)
            width: 15px
            right: 20px
    &_right
        display: flex 
        align-items: center
        gap: 20px
    &Right 
        &_actions 
            display: flex
            align-items: center
            gap: 10px
        &Actions 
            &_button 
                width: 20px
        &_avatar
            width: 40px
            border-radius: 100%
            overflow: hidden
            img 
                width: 40px
                border-radius: 100%
</style>