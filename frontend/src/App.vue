<template>
    <div>
        <TheNavBar/>
        <div class="m-auto w-10/12">
            <router-view></router-view>
        </div>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import TheNavBar from './components/TheNavBar.vue';

@Component({
  components: {
    TheNavBar
  },
})
export default class App extends Vue {
  public created () {
    this.$store.dispatch('checkLocalStorage');
  }
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
