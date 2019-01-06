import Vue from 'vue';
import Component from 'vue-class-component';

@Component({
  props: {
    message: {
      default: 'some message',
      type: String,
    },
    size: Number,
  },
})
export default class ExampleComponent extends Vue {
  public static data(): object {
    return {};
  }

  public static mounted(): void {
    // console.log('CComponent mounted.');
    // this.size = this.data.size;
  }
}
