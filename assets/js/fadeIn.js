document.addEventListener('DOMContentLoaded', () => {
    const revealElements = document.querySelectorAll('.reveal');  // Modifier ici pour correspondre à 'reveal'

    function checkVisibility() {
        const windowHeight = window.innerHeight;

        revealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;

            if (elementTop < windowHeight * 0.8) {
                element.classList.add('reveal-visible');  // Assurez-vous que la classe 'reveal-visible' est ajoutée
            }
        });
    }

    // Appel initial pour afficher les éléments déjà visibles
    checkVisibility();

    // Ajouter l'écouteur d'événements lors du défilement
    window.addEventListener('scroll', checkVisibility);
});
