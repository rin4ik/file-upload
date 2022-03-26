<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
            </div>
            <form  class="mt-8 mb-3 space-y-6" @submit.prevent="login">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                <label for="email-address" class="sr-only">Email address</label>
                <input v-model="form.email" id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                </div>
                <div>
                <label for="password" class="sr-only">Password</label>
                <input v-model="form.password" id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
            </div> 

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sign in
                </button>
            </div>
            </form>
            <p class="text-sm text-gray-800 ">Not joined yet ? 
                <router-link class="text-indigo-500" :to="{name: 'register'}">
                    Create an account
                </router-link>
            </p>
        </div>
    </div>
</template>

<script> 
import { mapActions } from 'vuex'
export default {
  name: 'Login',
  data(){
      return {
          form: {
              email: '',
              password: ''
          }
      }
  },
  methods: {
    ...mapActions({
        loginAction: 'auth/login'
    }),
    async login() {
        await this.loginAction(this.form)
        this.$router.replace({name: "account"})
    }
  }
}
</script>
