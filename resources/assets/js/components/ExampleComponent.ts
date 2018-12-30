import Vue from 'vue';
import Component from 'vue-class-component';

@Component({
  props: {
    size: Number,
  },
})
export default class ExampleComponent extends Vue {
  public message: string = 'some message';

  public data() {
    return {
    };
  }

  public mounted(): void {
    console.log('Component mounted.');
    // this.size = this.data.size;
  }
}
