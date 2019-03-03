import axios from 'axios';
import Vue from 'vue';
import {Component} from 'vue-property-decorator';

import Game from '../../models/Game';
import GameListItem from '../GameListItem/index.vue';

@Component({
  components: {
    GameListItem,
  },
})
export default class GameList extends Vue {
  public games: Game[] = [];

  public created() {
    return axios.get('/games')
      .then(({ data }) => {
        this.$data.games = data.games;
      })
      .catch((error) => {
        console.error(error);
        this.$data.games = [];
      });
  }
}
