<template>
    <header class="flex flex-wrap md:flex-no-wrap items-center justify-between mb-6 -mx-3 -mt-3">
        <ul class="flex items-center">
            <li>
                <router-link class="text-sm inline-block p-3 text-gray-800" to="/">Home</router-link>
            </li>
            <li>
                <router-link class="text-sm inline-block p-3 text-gray-800" :to="{name: 'uploads'}">Your files</router-link>
            </li>
        </ul> 
        <div class="flex justify-center order-last w-full md:w-auto md:order-none">
            <app-usage v-if="authenticated"/>
        </div>
        <ul class="flex items-center">
            <template v-if="!authenticated">
                <li>
                    <router-link class="text-sm inline-block p-3 text-gray-800" to="/login">Sign in</router-link>
                </li>
                <li>
                    <router-link class="text-sm inline-block p-3 text-gray-800" to="/register">Create account</router-link>
                </li>
            </template>
            <template v-else>
                <li>
                    <router-link  class="text-sm inline-block p-3 text-gray-800" :to="{name: 'account'}">
                        Account
                    </router-link>
                </li>
                <li>
                    <a @click.prevent="logout" href="" class="text-sm inline-block p-3 text-gray-800">Log out</a>
                </li>
            </template>
            <li v-if="!authenticated || !user.subscribed">
                <router-link class="text-sm inline-block p-3 text-indigo-600" :to="{name: 'plans'}">Upgrade ✨</router-link>
            </li>
        </ul>
    </header>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import AppUsage from '@/components/AppUsage'

export default ({
    components: { AppUsage },
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
    },
    methods: {
        ...mapActions({
            logoutAction: 'auth/logout'
        }),
        async logout(){
            await this.logoutAction()
            this.$router.replace({name: 'home'})
        }
    }
})
</script>
