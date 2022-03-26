import {createRouter, createWebHistory} from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Plans from '../views/Plans.vue'
import Register from '../views/Register.vue'
import Upload from '../views/Upload.vue'
import Checkout from '../views/Checkout.vue'
import Account from '../views/Account.vue'
import Swap from '../views/Swap.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/uploads',
        name: 'uploads',
        component: Upload
    },
    {
        path: '/plans',
        name: 'plans',
        component: Plans
    },
    {
        path: '/account',
        name: 'account',
        component: Account
    },
    {
        path: '/swap',
        name: 'swap',
        component: Swap
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        props: route => ({plan: route.query.plan})
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
]
export default createRouter({
    history: createWebHistory(),
    routes
})
