import Vue from 'vue';
import { Component } from 'vue-property-decorator';

@Component({
  props: {
    size: {
      type: Number,
    },
  },
})
export default class GameList extends Vue {
  public message: string = 'some garbage';

  get bar(): number {
    return 33;
  }
}
