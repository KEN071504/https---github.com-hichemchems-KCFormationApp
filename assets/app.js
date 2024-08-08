import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


//debut js modal
// Récupération des éléments DOM
const btnOuvrirModal = document.getElementById('btnOuvrirModal');
const modal = document.getElementById('modalNousContacter');
const spanClose = document.querySelector('.close');



// Ouvrir la modal
btnOuvrirModal.addEventListener('click', function() {
  modal.style.display = 'block';
});

// Fermer la modal en cliquant sur la croix
spanClose.addEventListener('click', function() {
  modal.style.display = 'none';
});

// Fermer la modal en cliquant en dehors de la modal
window.addEventListener('click', function(event) {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});


//fin js modal