import type { User, DataFromDb } from '@/stores/main.types'

export const useMainStore = defineStore('mainStore', {
    state: () => ({
        user: {
            token: "",
            username: "",
            avatar: "",
        } as User
    }),
    actions: {
        /**
         * Установить поля user в state
         * @param {User} User 
         */
        setUserInfo(User: User): void {
            this.user.avatar = User?.avatar ? User.avatar : 'avatar.jpg'
            this.user.username = User?.username ? User.username : ''
            this.user.token = User?.token ? User.token : ''
        },
        
        getUserInfo(): void {
            if(this.user.token) return;
            
            this.user.username = 'User'
            this.user.avatar = 'avatar.jpg'

        },

        /**
         * Авторизация
         * @param {string} username 
         * @param {string} password 
         */
        async login(username: string, password: string) {
            const config = useRuntimeConfig()

            let params = new URLSearchParams();
            params.append('username', username);
            params.append('password', password);
            params.append('q', 'login');

            try {
                await useFetch(config.public.BD + 'user.php', {
                    method: 'GET',
                    query: {
                        username: username,
                        password: password,
                        q: 'login'
                    }
                })
                    .then((res) => {
                        console.log(res)
                        const result = res.data.value as unknown as DataFromDb

                        if (!result.status) {
                            console.log(result.message)
                            return
                        }

                        this.setUserInfo(result.result[0])
                    })
                    .catch((err) => {
                        console.log('Ошибка при авторизации: ' + err)
                        return
                    })
            } catch {
                console.log('Ошибка при авторизации')
                return
            }
        },

        /**
         * Регистрация
         * @param {string} username
         * @param {string} password
         */
        async registration(username: string, password: string) {
            const config = useRuntimeConfig()

            try {
                await useFetch(config.public.BD + 'user.php', {
                    method: 'GET',
                    query: {
                        username: username,
                        password: password,
                        q: 'registration'
                    }
                })
                    .then((res) => {
                        const result = res.data.value as unknown as DataFromDb

                        if (!result.status) {
                            console.log(result.message)
                            return
                        }

                        this.setUserInfo(result.result[0])
                    })
                    .catch((err) => {
                        console.log('Ошибка при регистрации: ' + err)
                        return
                    })
            } catch {
                console.log('Ошибка при регистрации')
                return
            }
        },
    },
    persist: {
        storage: piniaPluginPersistedstate.localStorage()
    }
})