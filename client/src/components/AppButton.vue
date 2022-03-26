<template>
    <button :class="{'opacity-50' : disabled}" :disabled="disabled" class="bg-indigo-500 rounded-lg font-medium text-white px-4 py-3 leading-none">
        {{title}}
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
        }
    },
})
</script>

