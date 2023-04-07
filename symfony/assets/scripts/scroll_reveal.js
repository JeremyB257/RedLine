// Scroll Reveal Plug-In

// Home page
let watches = document.querySelectorAll('.watchReveal');
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

let reviews = document.querySelector('.reviewReveal');
ScrollReveal().reveal(reviews, {
  delay: 300,
  interval: 150,
  duration: 700,
  origin: 'bottom',
  distance: '50px',
});

let attributesLeft = document.querySelectorAll('.attrRevealLeft');
ScrollReveal().reveal(attributesLeft, {
  delay: 200,
  duration: 700,
  origin: 'left',
  distance: '50px',
});

let attributesRight = document.querySelectorAll('.attrRevealRight');
ScrollReveal().reveal(attributesRight, {
  delay: 300,
  duration: 700,
  origin: 'right',
  distance: '50px',
});

let xLaxar = document.querySelector('.xLaxarReveal');
ScrollReveal().reveal(xLaxar, {
  delay: 400,
  duration: 400,
  origin: 'top',
  distance: '50px',
});

let LaLaxar = document.querySelector('.laLaxarReveal');
ScrollReveal().reveal(LaLaxar, {
  delay: 200,
  duration: 400,
  origin: 'left',
  distance: '50px',
});

let ArLaxar = document.querySelector('.arLaxarReveal');
ScrollReveal().reveal(ArLaxar, {
  delay: 200,
  duration: 400,
  origin: 'right',
  distance: '50px',
});
