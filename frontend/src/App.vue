<template>
    <div>
        <TheNavBar/>
        <div class="m-auto w-10/12">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import TheNavBar from './components/TheNavBar'

export default {
  components: {
    TheNavBar,
  },
}
</script>

<style>
    .btn {
        @apply font-bold py-2 px-4 rounded;
    }

    .btn-primary {
        @apply bg-purple-300;
    }

    .btn-primary:hover {
        @apply bg-purple-400;
    }
</style>
