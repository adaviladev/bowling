<template>
    <div class="container">
        <h1>Game List</h1>

        <div class="card-columns">
            <GameListItem v-if="games"
                          v-for="game in games"
                          :game="game"
                          :key="game.id"
            ></GameListItem>
        </div>
    </div>
</template>

<script lang="ts">
  import axios from 'axios';
  import Vue from 'vue';
  import {Component} from 'vue-property-decorator';

  import GameListItem from './GameListItem.vue';

  @Component({
    components: {
      GameListItem,
    },
  })
  export default class GameList extends Vue {
    public games: object[] = [];

    public created() {
      return axios.get('/api/games')
        .then(({ data }) => {
          this.$data.games = data.games;
        })
        .catch((error) => {
          console.error(error);
        });
    }
  }
</script>

<style></style>
