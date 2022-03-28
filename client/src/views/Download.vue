<template>
    <div class="mt-5">
        <div class="p-12 rounded-lg bg-gray-100 text-center" v-if="file && meta">
            <h1 class="text-xl text-medium mb-3  text-gray-500">{{file.name}}</h1>
            <app-button @click.prevent="download" title="Download this file" />
        </div>
        <div v-if="error">
            <p class="text-sm text-center text-red-800">Sorry, this file is not available</p>
        </div>
        </div>
</template>
<script> 
import AppButton from '@/components/AppButton'
import axios from 'axios' 

export default ({
    components: {AppButton},
    props: {
        uuid: {
            type: String,
            required: true
        },
        token: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            error: false, 
            file: null,
            meta: null
        }
    },
    methods: {
        download() {
            let dummy = document.createElement('a')
            dummy.href = this.meta.url
            document.body.appendChild(dummy)
            dummy.click()
            document.body.removeChild(dummy)
        },
        async getFile() {
            try {
                let response = await axios.get(`api/files/${this.uuid}/links?token=${this.token}`)
                this.file = response.data.data
                this.meta = response.data.meta
            } catch (error) {
                this.error = true
            }
        }
    },
    mounted() {
        this.getFile()
    }
})
</script>
