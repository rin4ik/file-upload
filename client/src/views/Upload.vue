<template>
    <div>
        <div class="mb-8">
            Uploader
        </div>
        <div>
            <h2 class="font-medium border-b-2 border-gray-100 text-gray-800">Your files</h2>
            <template v-if="files.length">
                <app-file :file="file" v-for="file in files" :key="file.uuid"/>
            </template>
            <p v-else class="mt-3 text-sm text-gray-800">There are no files here right now</p>
        </div>
    </div> 
</template>

<script> 
import { mapActions, mapGetters } from 'vuex'
import AppFile from '@/components/AppFile'
export default {
  name: 'Upload',
  components: { AppFile },
  methods: {
      ...mapActions({
          getFiles: 'files/getFiles'
      })
  },
  computed: {
      ...mapGetters({
          files: 'files/files'
      })
  },
  mounted() {
      this.getFiles()
  }
}
</script>
