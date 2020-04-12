<template>
    <div class="m-auto w-10/12">
        Game #{{ game.id }}
        <frames-table v-if="game"
            :data-vue="`game-${game.id}-frames`"
            :game="game"
            :rolls="game.rolls"/>
    </div>
</template>

<script lang="ts">
import axios, { AxiosResponse } from "axios";
import {
  Component,
  Prop,
  Vue
} from "vue-property-decorator";
import FramesTable from "@/components/FramesTable.vue";
import Game from "../Models/Game";
import {
  IGame,
  IRoll
} from '@/Interfaces/interfaces';

@Component({
  components: {
    FramesTable
  }
})
export default class PageGameShow extends Vue {
  public game: Game = {} as Game;

  public created(): void {
    axios.get(`/api/games/${this.$route.params.id}`).then(({ data }: AxiosResponse) => {
      this.game = Game.make(data.game as IGame);
      this.game.calculateScore();
    });
  }

  get rolls(): IRoll[] {
    return this.game.rolls;
  }
}
</script>

<style scoped></style>
