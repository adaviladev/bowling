import axios from 'axios';
import Vue from 'vue';
import {Component} from 'vue-property-decorator';
import FramesTable from '../../components/FramesTable/index.vue';

@Component({
  components: {
    FramesTable,
  },
  props: {
    id: {
      type: [Number, String],
    },
  },
})
export default class PageGameShow extends Vue {
  private game: object = {};

  public created() {
    axios.get(`/api/games/${this.$props.id}`)
      .then(({data}) => {
        this.game = data.game;
      });
  }
}
