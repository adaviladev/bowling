import {Component, Prop, Vue} from 'vue-property-decorator';
import Frame from '../../models/Frame';

@Component
export default class FramesTable extends Vue {
  @Prop(Array) private frames!: Frame[];
  @Prop(Number) private score!: number;
  private MAX_FRAMES: number = 10;
}
