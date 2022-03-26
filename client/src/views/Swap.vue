<template>
    <form action="#" @submit.prevent="swap">
        <div class="mb-6"> 
            <div class="mb-2 flex items-center" v-for="plan in plans" :key="plan.slug" >
                <input type="radio" name="plan" :id="`plan_${plan.slug}`" class="mr-3 cursor-pointer" :value="plan.slug" v-model="form.plan">
                <label :for="`plan_${plan.slug}`" class="flex-grow cursor-pointer">
                    <app-plan :plan="plan"/>
                </label>
            </div>
        </div>
        <button class="bg-indigo-500 rounded-lg font-medium text-white px-4 py-3 leading-none">
            Swap
        </button>
    </form>
</template>

<script> 
import axios from "axios"
import AppPlan from '@/components/AppPlan'

export default ({
    components: {AppPlan},
    data() {
        return {
            form: {
                plan: null
            },
            plans: []
        }
    },

    methods: {
        swap() {
            console.log(this.form)
        }
    },
    async mounted() {
        let plans = await axios.get('api/plans')
        this.plans = plans.data.data
    } 
})
</script>

