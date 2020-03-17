<template>
    <form id="game-create"
        @submit.prevent="saveGame">
        <frames-table
            :editing="true"
            :game="game"
            :frames="game.frames"
        />

        <button class="btn btn-primary"
            id="game-store"
            type="submit">
            Create
        </button>
    </form>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import axios, { AxiosResponse } from "axios";
import Game from "../Models/Game";
import FramesTable from "@/components/FramesTable.vue";
import { IGame } from "@/Interfaces/interfaces";
import Frame from '@/Models/Frame';

@Component({
  components: {
    FramesTable,
  }
})
export default class GameEditor extends Vue {
  public game: Game = Game.make();

  public saveGame(): void {
    axios
      .post("/api/games", {
        game: this.game
      })
      .then((response: AxiosResponse) => {
        // console.log("response:", response);
        // this.game = Game.make(response.data.game as IGame);
        // console.log(this.game);
      });
  }
}
</script>

<style scoped></style>
