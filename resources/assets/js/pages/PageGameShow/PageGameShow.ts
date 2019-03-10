import axios from 'axios';
import Vue from 'vue';
import {Component} from 'vue-property-decorator';
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
  props: {
    id: {
      type: [Number, String],
    },
  },
})
export default class PageGameShow extends Vue {
  public game: IGame;

  constructor(params) {
    super(params);
    this.game = Game.make({});
  }

  public created() {
    axios.get(`/api/games/${this.$props.id}`)
      .then(({data}) => {
        this.$data.game = data.game;
      });
  }

  get rolls() {
    const frames = this.$data.game.frames;
    return [].concat(...frames.map((frame: IFrame) => frame.rolls));
  }
}
