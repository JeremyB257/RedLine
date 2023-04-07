import {Controller} from '@hotwired/stimulus';

export default class Fav extends Controller {
  connect(favElements) {
    this.favElements = favElements;

    if (this.favElements) {
    }
  }
}
