import Vue from 'vue';
import {Component} from 'vue-property-decorator';
import Frame from '../../models/Frame';

@Component({
  props: {
    game: Object,
  },
})
export default class GameListItem extends Vue {
  get performanceClass() {
    if (this.$props.game.score >= 200) {
      return 'bg-success';
    }
    if (this.$props.game.score >= 100) {
      return 'bg-warning';
    }

    return 'bg-danger';
  }
}
