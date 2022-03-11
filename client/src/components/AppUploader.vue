<template>
    <input type="file" name="file" ref="file" multiple/>
</template> 
<script> 
import axios from 'axios'
import * as Filepond from 'filepond'
export default ({
    mounted() {
        const pond = Filepond.create(this.$refs.file, {
            allowRevert: false,
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    let form = new FormData()
                    const cancelTokenSource = axios.CancelToken.source()
                    axios.post('api/files/signed', {
                        name: metadata.fileInfo.name,
                        extension: metadata.fileInfo.extension,
                        size: metadata.fileInfo.size
                    }).then((response) => {
                        file.additionalData = response.data.additionalData
                        for(var field in file.additionalData) {
                            form.append(field, file.additionalData[field])
                        }
                        form.append('file', file)
                        axios.post(response.data.attributes.action, form, {
                            onUploadProgress(e) {
                                progress(e.lengthComputable, e.loaded, e.total)
                            },
                            cancelToken: cancelTokenSource.token   
                        }).then(() =>{ 
                            load(`${file.additionalData.key}`)
                        })
                    })
                    return {
                        abort: () => {
                            cancelTokenSource.cancel()
                            abort()
                        }
                    }
                }
            },
            onprocessfile: (error, file) => {
                if(error) {
                    return
                }
                pond.removeFile(file)
                this.$emit('onprocessfile', file)
            },
            onaddfile: (error, file) => {
                if(error) {
                    return
                }
                file.setMetadata('fileInfo', {
                    name: file.filenameWithoutExtension,
                    extension: file.fileExtension,
                    size: file.fileSize
                })
            }
        })
    }
})
</script>
