import Vue from 'vue';
import {Component} from 'vue-property-decorator';

@Component({
  props: {
    game: Object,
  },
})
export default class GameListItem extends Vue {}
