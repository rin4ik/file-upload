import {createRouter, createWebHistory, routerKey} from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Plans from '../views/Plans.vue'
import Register from '../views/Register.vue'
import Upload from '../views/Upload.vue'
import Checkout from '../views/Checkout.vue'
import Account from '../views/Account.vue'
import Swap from '../views/Swap.vue'
import Download from '../views/Download.vue'
import subscribed from '@/middleware/subscribed'
import auth from '@/middleware/auth'
import store from '@/store'
import middlewarePipeline from './middlewarePipeline'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/uploads',
        name: 'uploads',
        component: Upload,
        meta: {
            middleware: [auth]
        }
    },
    {
        path: '/plans',
        name: 'plans',
        component: Plans
    },
    {
        path: '/account',
        name: 'account',
        component: Account,
        meta: {
            middleware: [auth]
        }
    },
    {
        path: '/swap',
        name: 'swap',
        component: Swap,
        meta: {
            middleware: [auth, subscribed]
        }
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        props: route => ({plan: route.query.plan}),
        meta: {
            middleware: [auth]
        }
    },
    {
        path: '/download/:uuid',
        name: 'download-uuid',
        component: Download,
        props: route => ({uuid: route.params.uuid, token: route.query.token})
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

const router = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach((to, from, next) => {
    if(!to.meta.middleware) {
        return next();
    }
    const middleware = to.meta.middleware
    const context = {
        to, from, store, next
    }
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
})
export default  router
