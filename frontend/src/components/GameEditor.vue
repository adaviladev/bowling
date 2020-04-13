<template>
    <form id="game-create"
        @submit.prevent="saveGame">
        <button class="btn btn-info btn-primary"
            id="game-store"
            type="submit">
            Create
        </button>
    </form>
</template>

<script>
import axios from "axios";
import Game from "@/Models/Game";

export default {
  data() {
    return {
      game: Game.make(),
    };
  },

  methods: {
    saveGame() {
      axios
        .post('/api/games/', {
          game: this.game,
        })
        .then((response) => {
          // console.log("response:", response);
          // this.game = Game.make(response.data.game as IGame);
          // console.log(this.game);
        });
    }
  }
}
</script>

<style scoped></style>
