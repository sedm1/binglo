<template>
    <main>
        <section class="main">
            <div class="container">
                <div class="main_block">
                    <h1 class="main_title">Регистрация</h1>
                    <form class="main_form" @submit.prevent="">
                        <div class="mainForm_item">
                            <input v-model="username" type="text" class="mainForm_input"
                                :class="{ 'mainForm_input-error': isUserNameEmpty }" placeholder="Введите логин">
                            <p class="mainFormItem_error" v-if="isUserNameEmpty">Логим должен быть больше 5 символов</p>
                        </div>
                        <div class="mainForm_item">
                            <input type="password" v-model="password" class="mainForm_input"
                                :class="{ 'mainForm_input-error': isPasswordNotEqual }" placeholder="Введите пароль">
                            <p class="mainFormItem_error" v-if="isPasswordNotEqual">Пароли должны совпадать</p>
                        </div>
                        <div class="mainForm_item">
                            <input type="password" v-model="secondPassword" class="mainForm_input"
                                :class="{ 'mainForm_input-error': isPasswordNotEqual }"
                                placeholder="Введите пароль повторно">
                            <p class="mainFormItem_error" v-if="isPasswordNotEqual">Пароли должны совпадать</p>
                        </div>
                        <button class="mainForm_button" @click="registration()">Создать аккаунт
                        </button>
                    </form>
                    <div class="main_footer">
                        <p class="mainFooter_descript">Есть аккаунт?</p>
                        <NuxtLink to="/login" class="mainFooter_link">Войти</NuxtLink>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script setup lang="ts">
import { useMainStore } from '@/stores/main';
const mainStore = useMainStore()

const username: Ref<string> = ref('')
const password: Ref<string> = ref('')
const secondPassword: Ref<string> = ref('')

const isUserNameEmpty: Ref<boolean> = ref(false)
const isPasswordNotEqual: Ref<boolean> = ref(false)

const checkFields = (): boolean => {
    const isUsernameNormal = username.value.length <= 3
    const isPasswordNormal = password.value !== secondPassword.value

    isUsernameNormal ? isUserNameEmpty.value = true : isUserNameEmpty.value = false
    isPasswordNormal ? isPasswordNotEqual.value = true : isPasswordNotEqual.value = false

    return !(isUserNameEmpty.value || isPasswordNotEqual.value || !password.value)
}

const registration = () => {
    if(!checkFields()) return;
    mainStore.registration(username.value, password.value)
    
}
</script>
<style lang="sass" scoped>
.main
    height: calc(100dvh - 67px)
    display: flex
    justify-content: center
    align-items: center
    &_block
        display: flex
        align-items: center
        flex-direction: column
    &_title 
        font-size: 32px
        font-weight: 700
        margin-bottom: 20px
    &_form 
        display: flex
        flex-direction: column
        gap: 15px
        max-width: 550px
        width: 100%
    &Form 
        &_input
            width: 100%
            padding: 10px 15px
            background: $whiteGray
            border-radius: 5px
            border: 1px solid $whiteGray
            &-error 
                border-color: $red
        &_button
            width: 100%
            padding: 10px 0px
            background: $blue 
            color: $white
            font-size: 14px
            font-weight: 500
            justify-content: center
            border-radius: 5px
            border: 1px solid $blue 
            transition: .3s
            &:hover 
                background: rgba(0, 0, 0, 0) 
                color: $blue
        &Item 
            &_error
                color: $red
                font-size: 12px
    &_footer
        margin-top: 10px
        display: flex
        align-items: center
        gap: 5px
    &Footer 
        &_descript
            font-size: 14px
        &_link 
            font-size: 14px
            color: $blue
</style>