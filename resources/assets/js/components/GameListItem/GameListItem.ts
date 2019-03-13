import Vue from 'vue';
import {
  Component,
  Prop,
} from 'vue-property-decorator';
import {IGame} from '../../models/types';

@Component
export default class GameListItem extends Vue {
  @Prop(Object) public readonly game!: IGame;

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
