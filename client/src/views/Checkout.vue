<template>
    <form action="" @submit.prevent="submit">
        <div class="mb-6">  
            <label for="name" class="inline-block text-sm mb-2">Your name</label> 
            <input v-model="form.name" id="name" name="text" type="name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </div>
        <div class="mb-6">
            <label for="card-details" class="inline-block text-sm mb-2">Card details</label> 
            <div id="card" ref="card"></div>
        </div> 
        <app-button :disabled="loading" :loading="loading" type="submit" title="Pay"/> 
    </form>
</template>
<script>
import axios from "axios"
import { mapActions } from 'vuex'
import AppButton from '@/components/AppButton'
const stripe = Stripe(process.env.VUE_APP_STRIPE_KEY)
const elements = stripe.elements()
const cardElement = elements.create('card')

export default ({
    components: {AppButton},
    props: {
        plan: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            loading: false,
            intent : {
                client_secret: null
            },
            form: {
                name: ''
            }
        }
    },
    methods: {
        ...mapActions({
            me: 'auth/me',
            snack: 'snack/snack'
        }),
        async submit () {
            this.loading = true
            const {setupIntent, error} = await stripe.confirmCardSetup(
                this.intent.client_secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details:  {name: this.form.name}
                    }
                }
            )

            if (error) {
                this.loading = false
            } else {
                await this.createSubscription(setupIntent.payment_method)
                this.loading = false
            }
        },
        async createSubscription(token) {
            await axios.post('api/subscriptions', {token: token, plan: this.plan})
            await this.me()
            this.snack('Subscription created. Thank you!')
            this.$router.replace({name: 'account'})
        }
    },
    async mounted() { 
        let response = await axios.get('api/subscriptions/intent')
        this.intent.client_secret =  response.data.data.client_secret
        cardElement.mount(this.$refs.card)
    }
})
</script>
