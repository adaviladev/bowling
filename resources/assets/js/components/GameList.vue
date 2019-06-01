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
  import axios, { AxiosResponse } from 'axios';
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

    public created(): void {
      axios.get('/api/games')
        .then((response: AxiosResponse) => {
          this.games = response.data.games;
        })
        .catch((error: AxiosResponse) => {
          console.error(error);
        });
    }
  }
</script>

<style></style>
