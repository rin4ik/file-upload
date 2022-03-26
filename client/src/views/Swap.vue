<template>
    <form action="#" @submit.prevent="swap"> 
        <div class="mb-6"> 
            <div class="mb-2 flex items-center" v-for="plan in plans" :key="plan.slug" >
                <input type="radio" name="plan" :id="`plan_${plan.slug}`" class="mr-3 cursor-pointer" :value="plan.slug" 
                v-model="form.plan" v-if="availablePlans.find(p => p.slug === plan.slug)">
                <label :for="`plan_${plan.slug}`" class="flex-grow cursor-pointer">
                    <app-plan :plan="plan"/>
                </label>
            </div>
        </div>
        <app-button :disabled="loading || !form.plan" :loading="loading" type="submit" title="Swap" v-if="availablePlans.length" /> 
        <p v-else class="text-gray-800 text-sm">
            There are no available plans for you to swap to right now, because you're using too much storage.
        </p>
    </form>
</template>

<script> 
import axios from "axios"
import AppPlan from '@/components/AppPlan'
import { mapGetters, mapActions } from "vuex"
import AppButton from '@/components/AppButton'
export default ({
    components: { AppPlan, AppButton },
    data() {
        return {
            form: {
                plan: null
            },
            plans: [],
            loading: false,
            planAvailability: [],
        }
    },

    methods: {
        ...mapActions({
            me: 'auth/me'
        }),
        async swap() { 
            this.loading = true
            await axios.patch('api/subscriptions', this.form) 
            await this.me()
            this.loading = false
            this.$router.replace({ name: 'account' })  
        }
    },
    computed: {
        ...mapGetters({
            'user': 'auth/user'
        }),
        availablePlans () {
            return this.plans.filter(p => p.slug !== this.user.plan.slug && this.planAvailability[p.slug])
        }
    },
    async mounted() {
        let plans = await axios.get('api/plans')
        this.plans = plans.data.data

        let planAvailability = await axios.get('api/user/plan_availability')
        this.planAvailability = planAvailability.data.data
    } 
})
</script>

