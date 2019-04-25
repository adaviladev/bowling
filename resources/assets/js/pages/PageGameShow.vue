<template>
    <div>
        Game #{{ id }}
        <FramesTable
            v-if="game"
            :data-vue="`game-${id}-frames`"
            :frames="game.frames"
            :score="game.score"
        ></FramesTable>
    </div>
</template>

<script lang="ts">
  import axios from 'axios';
  import {
    Component,
    Prop,
    Vue,
  } from 'vue-property-decorator';
  import FramesTable from '../components/FramesTable.vue';
  import Game from '../models/Game';
  import {
    IFrame,
    IGame,
  } from '../models/types';

  @Component({
    components: {
      FramesTable,
    },
  })
  export default class PageGameShow extends Vue {
    @Prop([Number, String]) public readonly id!: number;

    public game: Game = {} as Game;

    public created() {
      axios.get(`/api/games/${this.id}`)
        .then(({data}) => {
          this.game = new Game(data.game as IGame);
          this.game.calculateScore();
        });
    }

    get frames() {
      return this.game.frames;
    }
  }
</script>

<style scoped>

</style>