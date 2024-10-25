import './bootstrap.js';
import './styles/app.css';
import "bootstrap/dist/css/bootstrap.min.css";
import 'bootstrap';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// Changement de mots 
document.addEventListener('DOMContentLoaded', () => {
  const wordElement = document.getElementById('word');
  const words = ['créative','adaptable', 'à l\'écoute', 'passionnée'];
  let currentIndex = 0;

  function changeWord() {
    wordElement.style.opacity = 0; 
    setTimeout(() => {
      currentIndex = (currentIndex + 1) % words.length;
      wordElement.textContent = words[currentIndex]; 
      wordElement.style.opacity = 1; 
    }, 500); 
  }

  setInterval(changeWord, 3000); 
});


// Navbar scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');

    function handleScroll() {
        console.log('Scroll Y:', window.scrollY); 
        if (window.scrollY > 50) {
            if (!navbar.classList.contains('scrolled')) {
                navbar.classList.add('scrolled');
            }
        } else {
            if (navbar.classList.contains('scrolled')) {
                navbar.classList.remove('scrolled');
            }
        }
    }

    window.addEventListener('scroll', handleScroll);

    handleScroll();
});


//Chevron down
document.addEventListener('DOMContentLoaded', function() {
  const scrollIcon = document.querySelector('.scroll-down-icon');

  if (scrollIcon) {
      scrollIcon.addEventListener('click', function(event) {
          event.preventDefault(); 

          const target = document.querySelector('#project');
   
          if (target) {
              target.scrollIntoView({ behavior: 'smooth' });
          }
      });
  }
});


//popup
document.addEventListener('DOMContentLoaded', (event) => {
    const contentLinks = document.querySelectorAll('.content-link');
    const popups = document.querySelectorAll('.popup');
    const closeButtons = document.querySelectorAll('.close');
  
    contentLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default anchor action
        const popupId = link.getAttribute('data-popup');
        const popup = document.getElementById(popupId);
        if (popup) {
          popup.style.display = 'block'; // Show the popup
        }
      });
    });
  
    closeButtons.forEach(button => {
      button.addEventListener('click', () => {
        const popup = button.closest('.popup');
        if (popup) {
          popup.style.display = 'none'; // Hide the popup
        }
      });
    });
  
    window.addEventListener('click', (e) => {
      if (e.target.classList.contains('popup')) {
        e.target.style.display = 'none'; // Hide the popup when clicking outside of it
      }
    });
  });
  const contactButtons = document.querySelectorAll('.contact-button-popup');
  contactButtons.forEach(button => {
      button.addEventListener('click', function() {
          window.location.href = '/contact'; 
      });
  });
  
  
// defilement page 
document.addEventListener('DOMContentLoaded', () => {
  const fadeInElements = document.querySelectorAll('.fade-in');

  function checkVisibility() {
    const windowHeight = window.innerHeight;
    
    fadeInElements.forEach(element => {
      const elementTop = element.getBoundingClientRect().top;

      if (elementTop < windowHeight * 0.8) { 
        element.classList.add('visible');
      }
    });
  }

  // Initial check to handle already visible elements
  checkVisibility();
  
  // Check visibility on scroll
  window.addEventListener('scroll', checkVisibility);
});


// blog page
document.addEventListener("DOMContentLoaded", function() {
  const articles = document.querySelectorAll('.card');

  articles.forEach((article, index) => {
      article.style.opacity = 0;
      article.style.transform = 'translateY(20px)';
      article.style.transition = 'opacity 0.5s ease, transform 0.5s ease'; // Ajout de la transition ici

      setTimeout(() => {
          article.style.opacity = 1;
          article.style.transform = 'translateY(0)';
      }, index * 100);
  });
});


//realisation

