import Vue from 'vue';
import {Component} from 'vue-property-decorator';

import FramesTable from '../FramesTable/index.vue';

@Component({
  components: {
    FramesTable,
  },
  props: {
    game: Object,
  },
})
export default class GameListItem extends Vue {}
