import Vue from 'vue';
import {Component} from 'vue-property-decorator';

@Component({
  props: {
    frames: Array,
  },
})
export default class FramesTable extends Vue {
  private MAX_FRAMES = 10;
}
