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

const searchBtn = document.querySelector('#searchBtn');
searchBtn.addEventListener('click', e => {
  e.target.previousElementSibling.classList.toggle('show');
});

const picFilter = document.querySelectorAll('.size-filter');
const colorFilter = document.querySelectorAll('.colors');
const mainImg = document.querySelector('.main-img');

if (picFilter) {
  for (const img of picFilter) {
    img.addEventListener('click', e => {
      mainImg.src = e.target.src;
    });
  }
}

if (colorFilter) {
  for (const color of colorFilter) {
    color.addEventListener('click', e => {
      if (mainImg.src.includes('-')) {
        mainImg.src = mainImg.src.split('-')[0] + '-' + color.dataset.color + '.png';
      }
    });
  }
}
