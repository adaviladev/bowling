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

<script lang="ts">
import axios, { AxiosResponse } from "axios";
import Vue from "vue";
import { Component } from "vue-property-decorator";

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
        });
    }
}
</script>

<style></style>
