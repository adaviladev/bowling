import axios from 'axios';
import {
  Component,
  Prop,
  Vue,
} from 'vue-property-decorator';
import FramesTable from '../../components/FramesTable/index.vue';
import Game from '../../models/Game';
import {
  IFrame,
  IGame,
} from '../../models/types';

@Component({
  components: {
    FramesTable,
  },
})
export default class PageGameShow extends Vue {
  @Prop([Number, String]) public readonly id!: number;

  public game: Game = {} as Game;

  public created() {
    axios.get(`/api/games/${this.$props.id}`)
      .then(({data}) => {
        this.game = new Game(data.game as IGame);
        this.game.calculateScore();
      });
  }

  get frames() {
    return this.$data.game.frames;
  }
}
