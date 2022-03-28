<template>
  <div class="w-full md:w-8/12 lg:w-6/12 mx-auto px-6 mt-6 md:mt-20">
        <app-snack/>
        <app-nav/>
        <router-view></router-view>
    </div>
</template>
<script> 
import AppNav from '@/components/AppNav'
import AppSnack from '@/components/AppSnack'
export default ({
    components: {AppNav, AppSnack}
})
</script>

<style src="./assets/styles/app.css"></style>
