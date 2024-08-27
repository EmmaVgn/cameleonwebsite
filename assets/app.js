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
                console.log('Adding "scrolled" class'); 
                navbar.classList.add('scrolled');
            }
        } else {
            if (navbar.classList.contains('scrolled')) {
                console.log('Removing "scrolled" class'); 
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
        console.log('Icône de défilement cliquée !');

        event.preventDefault(); 

        const target = document.querySelector('#custom-jumbotron');
 
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});