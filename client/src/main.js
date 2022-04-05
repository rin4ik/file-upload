import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import store from './store'

axios.defaults.baseURL = process.env.VUE_APP_API_URL
axios.defaults.withCredentials = true

store.dispatch('auth/me').then(() => {
    createApp(App).use(store).use(router).mount('#app')
})
