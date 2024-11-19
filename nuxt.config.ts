// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  modules: ['@pinia/nuxt', ['@nuxtjs/google-fonts', {
    families: {
      'Poppins': true
    }
  }]],
  runtimeConfig: {
    public: {
      BD: 'http://binglo/src/server/api/'
    }
  },
  vite: {
    css: {
        preprocessorOptions: {
            sass: {
                additionalData: '@import "@/assets/sass/main.sass"',
            },
        },
    },
  },
})