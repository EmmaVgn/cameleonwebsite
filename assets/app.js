import './bootstrap.js';
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

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

    scrollIcon.addEventListener('click', function(event) {

        event.preventDefault(); 

        const target = document.querySelector('#project');
 
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
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
  

  // Numéro de siret
  document.addEventListener('DOMContentLoaded', function() {
    const companyNameField = document.querySelector('input[name="contact[companyName]"]');
    const siretNumberField = document.querySelector('input[name="contact[siretNumber]"]');

    function toggleSiretField() {
        if (companyNameField.value.trim() !== '') {
            siretNumberField.closest('.form-group').style.display = 'block';
        } else {
            siretNumberField.closest('.form-group').style.display = 'none';
        }
    }

    companyNameField.addEventListener('input', toggleSiretField);

    // Initial check
    toggleSiretField();
});
