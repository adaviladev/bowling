import Vue from 'vue';
import {Component} from 'vue-property-decorator';
import {IRoll} from '../../models/types';

@Component({
  props: {
    rolls: Array,
  },
})
export default class FramesTable extends Vue {
  private MAX_FRAMES: number = 10;
  private score: number = 0;

  public created() {
    this.score = this.calculateScore();
  }

  private calculateScore() {
    const rolls = this.$props.rolls;
    let total = 0;
    let roll = 0;
    for (let i = 0; i < this.MAX_FRAMES; i++) {
      if (rolls[roll].pins === 10) {
        total += 10 + rolls[roll + 1].pins + rolls[roll + 2].pins;
        roll++;
      } else if (rolls[roll].pins + rolls[roll + 1].pins === 10) {
        total += 10 + rolls[roll + 2].pins;
        roll += 2;
      } else {
        total += rolls[roll].pins + rolls[roll + 1].pins;
        roll += 2;
      }
    }
    return total;
  }
}
