<template>
    <div class="m-auto max-w-md ">
        <img alt="Vue logo"
            class="self-center m-auto"
            src="../assets/logo.png"/>
        <HelloWorld msg="Welcome to Your Vue.js App"/>
    </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'home',
  components: {
    HelloWorld,
  },
}
</script>
