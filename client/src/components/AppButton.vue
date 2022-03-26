<template>
    <button :class="{'opacity-50' : disabled}" 
        :disabled="disabled" class="bg-indigo-500 rounded-lg font-medium text-white px-4 py-3 leading-none"
    >
        <span v-if="loading">Just a sec...</span>
        <span v-else>{{title}}</span> 
    </button>
</template>
<script> 

export default ({
    props: {
        title: {
            required: true,
            type: String
        },
        disabled: {
            type: Boolean,
            required: false
        },
        loading: {
            type: Boolean,
            required: false
        }
    },
})
</script>

