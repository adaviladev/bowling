<template>
    <div class="mx-auto px-2">
        <h1 class="text-3xl">Game List View</h1>

        <div class="flex flex-wrap -mx-2"
            v-if="games">
            <game-list-item :game="game"
                :key="game.id"
                v-for="game in games"/>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

import GameListItem from './GameListItem.vue';

export default {
  components: {
    GameListItem,
  },

  data () {
    return {
      games: [],
    }
  },

  created () {
    axios.get('/api/games')
      .then((response) => {
        this.games = response.data.games;
      })
      .catch((error) => {
      });
  }
}
</script>

<style></style>
