<template>
    <div>
        <TheNavBar></TheNavBar>
        <div class="container">
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

<style></style>
