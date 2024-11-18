document.addEventListener('DOMContentLoaded', (event) => {
  const contentLinks = document.querySelectorAll('.content-link');
  const popups = document.querySelectorAll('.popup');
  const closeButtons = document.querySelectorAll('.close');

  contentLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault(); // Empêche l'action par défaut (si c'était un lien)
      const popupId = link.getAttribute('data-popup');
      const popup = document.getElementById(popupId);
      if (popup) {
        popup.style.display = 'block'; // Affiche le popup
      }
    });
  });

  closeButtons.forEach(button => {
    button.addEventListener('click', () => {
      const popup = button.closest('.popup');
      if (popup) {
        popup.style.display = 'none'; // Masque le popup
      }
    });
  });

  window.addEventListener('click', (e) => {
    if (e.target.classList.contains('popup')) {
      e.target.style.display = 'none'; // Masque le popup si on clique en dehors de celui-ci
    }
  });
  
  const contactButtons = document.querySelectorAll('.contact-button-popup');
  contactButtons.forEach(button => {
    button.addEventListener('click', function() {
      window.location.href = '/contact'; 
    });
  });
});
