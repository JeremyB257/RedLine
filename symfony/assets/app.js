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

//-------

// Scroll Reveal Plug-In

// Home page
let watches = document.querySelectorAll('.watch');
ScrollReveal().reveal(watches, {
  interval: 200,
  reset: true,
  delay: 150,
  duration: 600,
  origin: 'bottom',
  distance: '50px',
});

let watchHomePage = document.querySelector('.imgReveal');
ScrollReveal().reveal(watchHomePage, {
  delay: 150,
  duration: 700,
  origin: 'top',
  distance: '50px',
});

let textHomePage = document.querySelectorAll('.titleReveal');
ScrollReveal().reveal(textHomePage, {
  delay: 300,
  interval: 150,
  duration: 700,
  origin: 'left',
  distance: '50px',
});
