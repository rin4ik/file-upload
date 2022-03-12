<template>
    <span class="inline-block text-sm font-medium text-gray-800 text-center bg-gray-200 rounded-lg py-1 px-2">
        Usage: {{usage}} / y (z%)
    </span>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

export default ({
    computed: {
        ...mapGetters({
            usage: 'usage/usage'
        })
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
