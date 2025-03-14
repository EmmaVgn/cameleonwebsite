// Changement de mots 
document.addEventListener('DOMContentLoaded', () => {
    const wordElement = document.getElementById('word');
    const userLang = document.documentElement.lang || navigator.language; // Détecte la langue de l'utilisateur

    // Définit les mots en fonction de la langue
    const words = userLang.startsWith('fr') ? 
        ['créative', 'adaptable', 'à l\'écoute', 'passionnée'] : 
        ['creative', 'adaptable', 'attentive', 'passionate'];

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