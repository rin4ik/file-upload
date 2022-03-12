<template>
     <div class="flex items-center justify-between border-b-2 border-gray-100">
         <div class="text-sm truncate overflow-ellipsis w-6/12">
             {{file.name}}
         </div>
         <div class="-mr-3 flex items-center"> 
            <a href="" class="inline-block text-sm p-3 text-indigo-500 font-medium">Get sharable link</a>
            <a @click.prevent="deleteFile" href="" class="inline-block text-sm p-3 text-pink-500 font-medium">Delete</a>
         </div>
     </div>
</template>
<script>  
import { mapActions, mapMutations } from "vuex";

export default ({ 
    props: {
        file: {
            required: true,
            type: Object
        }
    },
    methods: { 
        ...mapActions({
            deleteFileAction: 'files/deleteFile'
        }),
        ...mapMutations({
            decrementUsage: 'usage/DECREMENT_USAGE'
        }),
        async deleteFile(){
           await this.deleteFileAction(this.file.uuid)
           this.decrementUsage(this.file.size)
        }
    }
})
</script>
