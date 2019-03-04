import axios from 'axios';
import Vue from 'vue';
import {Component} from 'vue-property-decorator';

import GameListItem from '../GameListItem/index.vue';

@Component({
  components: {
    GameListItem,
  },
})
export default class GameList extends Vue {
  public games: object[] = [];

  public created() {
    return axios.get('/api/games')
      .then(({ data }) => {
        this.$data.games = data.games;
      })
      .catch((error) => {
        console.error(error);
      });
  }
}
