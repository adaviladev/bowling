import {Component, Prop, Vue, Watch} from 'vue-property-decorator';
import Frame from '../../models/Frame';
import Roll from '../../models/Roll';
import {
  IFrame,
  IRoll,
} from '../../models/types';

@Component
export default class FramesTable extends Vue {
  @Prop(Array) private frames!: Frame[];
  private MAX_FRAMES: number = 10;

  get score() {
    const frames = this.frames;
    if (!frames.length) {
      return 0;
    }
    const rolls: IRoll[] = this.rolls;
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

  get rolls(): IRoll[] {
    const rolls: IRoll[] = this.frames.reduce((accumulator: IRoll[], frame: IFrame) => {
      return accumulator.concat(frame.rolls);
    }, [] as IRoll[]);
    return rolls;
  }
}
