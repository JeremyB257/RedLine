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

//search navbar
const searchBtn = document.querySelector('#searchBtn');
if (searchBtn) {
  searchBtn.addEventListener('click', e => {
    e.target.previousElementSibling.classList.toggle('show');
  });
}

//pic & color picker on homepage
const picFilter = document.querySelectorAll('.little-pictures');
const colorFilter = document.querySelectorAll('.colors');
const mainImg = document.querySelector('.main-picture');
const formColor = document.querySelector('#form-color');

if (picFilter) {
  for (const img of picFilter) {
    img.addEventListener('click', e => {
      mainImg.src = e.target.src;
    });
  }
}

let selectedColor = '';

if (colorFilter) {
  colorFilter.forEach((color, index) => {
    if (index !== 0) {
      color.classList.add('desactive-color');
    } else {
      mainImg.src = mainImg.src.split('-')[0] + '-' + color.dataset.color + '.png';
      selectedColor = color.dataset.color;
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
        selectedColor = color.dataset.color;
      }
    });
  });
}

// Utilisez la variable selectedColor pour ajouter la couleur sélectionnée dans le panier
