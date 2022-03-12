<template>
    <span class="inline-block text-sm font-medium text-gray-800 text-center bg-gray-200 rounded-lg py-1 px-2">
        Usage: {{usageFormatted}} / {{storageFormatted}} ({{percentageUsed}}%)
    </span>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import filesize from 'filesize'

export default ({
    computed: {
        ...mapGetters({
            usage: 'usage/usage',
            user: 'auth/user'
        }),
        storageFormatted(){
            return filesize(this.user.plan.storage, {base: 2})
        },
        usageFormatted(){
            return filesize(this.usage, {base: 2})
        },
        percentageUsed() {
            return ((this.usage / this.user.plan.storage) * 100).toFixed(2)
        }
    },
    methods: {
        ...mapActions({
            getUsage: 'usage/getUsage'
        })
    },
    mounted() {
        this.getUsage()
    }
})
</script>
