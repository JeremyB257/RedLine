/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// import scroll reveal file
import './scroll_reveal';

// import fav feature
import Fav from './controllers/fav_controller.js';

//search navbar
const searchBtn = document.querySelector('#searchBtn');
const searchSubmit = document.querySelector('.searchSubmit');

if (searchBtn) {
  searchBtn.addEventListener('click', e => {
    e.target.previousElementSibling.classList.toggle('show');
    searchSubmit.style.transform = 'translate(0)';
  });
}

//pic & color picker on homepage
const picFilter = document.querySelectorAll('.little-pictures');
const colorFilter = document.querySelectorAll('.colors');
const mainImg = document.querySelector('.main-picture');
const formColor = document.querySelector('#form-color');

if (picFilter) {
  //OnClick in small Picture : change main picture
  for (const img of picFilter) {
    img.addEventListener('click', e => {
      mainImg.src = e.target.src;
    });
  }
}

if (colorFilter) {
  colorFilter.forEach((color, index) => {
    if (index !== 0) {
      color.classList.add('desactive-color');
    }

    color.addEventListener('click', e => {
      if (mainImg.src.includes('-')) {
        mainImg.src = mainImg.src.split('-')[0] + '-' + color.dataset.color + '.png';

        formColor.value = color.dataset.color;
        color.classList.remove('desactive-color');
        colorFilter.forEach(otherColor => {
          if (otherColor !== color) {
            otherColor.classList.add('desactive-color');
          }
        });
      }
    });
  });
}

//Rating review
const starRatingStars = document.querySelector('.gl-star-rating-stars');
const select = document.querySelector('select');
if (starRatingStars) {
  starRatingStars.addEventListener('click', e => {
    starRatingStars.classList.remove(starRatingStars.classList[1]);
    starRatingStars.classList.add('s' + e.target.dataset.value + '0');

    starRatingStars.nextElementSibling.innerText = e.target.dataset.text;
    select.value = e.target.dataset.value;
  });
}

// Fav feature

document.addEventListener('DOMContentLoaded', () => {
  const favElements = [].slice.call(document.querySelectorAll('a[data-action="fav"]'));
  console.log(favElements);
  if (favElements) {
    new Fav(favElements);
  }
});
