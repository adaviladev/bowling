import Vue from 'vue';
import Component from 'vue-class-component';

@Component({
  props: {
    size: Number,
  },
})
export default class Scripts extends Vue {
  public message: string = 'some message';

  public static data() {
    return {};
  }

  public static mounted(): void {
    console.log('CComponent mounted.');
    // this.size = this.data.size;
  }
}
