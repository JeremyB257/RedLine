import axios from 'axios';
import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
  favorite(event) {
    event.preventDefault();
    const url = this.element.href;
    axios.get(url).then(response => {
      const getSvgFilled = this.element.querySelector('svg.filled');
      const getSvgUnfilled = this.element.querySelector('svg.unfilled');

      getSvgFilled.classList.toggle('hidden');
      getSvgUnfilled.classList.toggle('hidden');
    });
  }
}
