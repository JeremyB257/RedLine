import axios from 'axios';
import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
  favorite(event) {
    event.preventDefault();
    const url = this.element.href;
    axios.get(url).then(response => {
      const getFilled = this.element.querySelector('i.filled');
      const getUnfilled = this.element.querySelector('i.unfilled');

      getFilled.classList.toggle('hidden');
      getUnfilled.classList.toggle('hidden');
    });
  }

  removeFavorite(event) {
    event.preventDefault();
    const url = this.element.href;
    axios.get(url).then(response => {
      const getBreakHeart = this.element.querySelector('.removefav');
      getBreakHeart.classList.add('disable');
    });
  }
}
