<template>
    <nav class="flex items-center justify-between text-gray-700 flex-wrap p-6">
        <div class="flex items-center flex-shrink-0 mr-6">
            <router-link class="font-semibold text-xl hover:text-purple-600"
                :to="{ name: 'Home' }">Bowling!
            </router-link>
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded border-purple-600 hover:text-purple hover:border-purple">
                <svg class="fill-current h-3 w-3"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <router-link class="block mt-4 lg:inline-block lg:mt-0 mr-4 hover:text-purple-600"
                    :to="{ name: 'Games' }">
                    Games
                </router-link>
                <router-link class="block mt-4 lg:inline-block lg:mt-0 mr-4 hover:text-purple-600"
                    :to="{ name: 'GameCreate' }">
                    Create
                </router-link>
            </div>
            <div v-if="guest">
                <router-link class="block mt-4 lg:inline-block lg:mt-0 hover:text-purple-600 mr-4"
                    :to="{ name: 'Login' }">
                    Login
                </router-link>
                <router-link :to="{ name: 'Register' }"
                    class="block mt-4 lg:inline-block lg:mt-0 hover:text-purple-600"> Register </router-link>
            </div>
            <div v-else>
                <form @submit.prevent="logout">
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from 'axios';
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState(['user']),
    guest() {
      return this.$store.state.user === null;
    }
  },

  methods: {
    logout() {
      axios.post('/api/logout');
      this.$store.dispatch('logout');
      this.$router.push({ name: 'Home' })
    }
  },

  watch: {
    user(value, oldValue) {
      return this.$store.state.user;
    }
  },
}
</script>

<style scoped></style>
