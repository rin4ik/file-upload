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
        <button v-if="availablePlans.length" class="bg-indigo-500 rounded-lg font-medium text-white px-4 py-3 leading-none">
            Swap
        </button>
        <p v-else class="text-gray-800 text-sm">
            There are no available plans for you to swap to right now, because you're using too much storage.
        </p>
    </form>
</template>

<script> 
import axios from "axios"
import AppPlan from '@/components/AppPlan'
import { mapGetters } from "vuex"

export default ({
    components: {AppPlan},
    data() {
        return {
            form: {
                plan: null
            },
            plans: [],
            planAvailability: [],
        }
    },

    methods: {
        swap() {
            console.log(this.form)
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

