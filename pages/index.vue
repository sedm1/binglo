<template>
    <main>
        <section class="main">
            <div class="container">
                <h1 class="main_title">Создавайте и следите за ходом <br/>разработки своих проектов</h1>
                <NuxtLink to="/boards" class="main_button">Перейти к доскам <img src="/icons/arrow-right.svg" alt="ArrowRight"></NuxtLink>
            </div>
        </section>
    </main>
</template>
<script setup lang="ts">
useHead({
  title: 'Главная страница - Binglo'
})
</script>
<style lang="sass" scoped>
.main
    height: calc(100dvh - 67px)
    display: flex
    align-items: center
    justify-content: center
    &_title
        font-size: 40px
        text-align: center
        font-weight: 800
        text-transform: uppercase
    &_button
        gap: 10px
        margin: 0 auto
        width: fit-content
        border: 1px solid $gray 
        padding: 10px 15px
        margin-top: 10px
        img
            width: 20px
</style>