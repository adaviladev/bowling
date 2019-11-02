<template>
  <form id="game-create" @submit.prevent="saveGame">
    <button class="btn btn-info" id="game-store" type="submit">
      Create
    </button>
  </form>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import axios, { AxiosResponse } from "axios";
import Game from "../models/Game";
import { IGame } from "../models/interfaces";

@Component
export default class GameEditor extends Vue {
  public game: Game = Game.make({} as IGame);

  public saveGame(): void {
    console.log("form submitted");
    axios
      .post("/api/games/", {
        game: this.game
      })
      .then((response: AxiosResponse) => {
        console.log("response:", response);
        // this.game = Game.make(response.data.game as IGame);
        console.log(this.game);
      });
  }
}
</script>

<style scoped></style>
