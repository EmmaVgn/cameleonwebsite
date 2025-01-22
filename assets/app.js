import "./bootstrap.js";
import "./styles/app.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";


console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");


//animation loading onglet navbar
document.addEventListener("DOMContentLoaded", function () {
  const navItems = document.querySelectorAll(".navbar-nav .nav-item");

  navItems.forEach((item) => {
    item.addEventListener("click", function (e) {
      e.preventDefault(); // Empêche la redirection immédiate

      // Supprime l'effet de loading des autres éléments
      navItems.forEach((nav) => nav.classList.remove("loading"));

      // Ajoute l'effet de loading au <li> cliqué
      this.classList.add("loading");

      // Simule un délai avant la redirection
      setTimeout(() => {
        window.location.href = this.querySelector(".nav-link").href; // Redirige après 1 seconde
      }, 1000); // Délai de 1 seconde
    });
  });
});

// bouton défilement vers le haut
document.addEventListener("DOMContentLoaded", function () {
  const scrollToTopBtn = document.getElementById("scrollToTopBtn");

  scrollToTopBtn.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth", // Défilement fluide
    });
  });
});

// pop up
document.querySelectorAll(".content-link").forEach((link) => {
  link.addEventListener("click", (event) => {
    const popupId = link.getAttribute("data-popup"); // Récupère l'ID de la pop-up
    const popup = document.getElementById(popupId);

    if (popup) {
      const popupContent = popup.querySelector(".popup-content");

      // Position du clic dans la fenêtre
      const clickY = event.clientY;

      // Appliquer le style dynamique
      popupContent.style.position = "absolute";
      popupContent.style.top = `${clickY}px`; // Applique la hauteur exacte du clic
      popupContent.style.left = "50%";
      popupContent.style.transform = "translate(-50%, 0)"; // Centre horizontalement

      // Affiche la pop-up
      popup.classList.add("active");
    }
  });
});

// Fermer la pop-up
document.querySelectorAll(".close").forEach((closeButton) => {
  closeButton.addEventListener("click", () => {
    const popup = closeButton.closest(".popup"); // Récupère l'élément parent
    if (popup) {
      popup.classList.remove("active"); // Masque la pop-up
    }
  });
});


document.addEventListener("DOMContentLoaded", function () {
    tarteaucitron.init({
        privacyUrl: "/politique-de-confidentialite",
        highPrivacy: true,
        googleConsentMode: true
    });

    console.log("Tarteaucitron est initialisé !");
});
