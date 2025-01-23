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

//pop-up
document.querySelectorAll(".content-link").forEach((link) => {
  link.addEventListener("click", () => {
    const popupId = link.getAttribute("data-popup");
    const popup = document.getElementById(popupId);

    if (popup) {
      const popupContent = popup.querySelector(".popup-content");

      // Définir les positions spécifiques en fonction de l'ID
      switch (popupId) {
        case "popup1":
          popupContent.style.top = "10%";
          break;
        case "popup2":
          popupContent.style.top = "20%";
          break;
        case "popup3":
          popupContent.style.top = "35%";
          break;
        case "popup4":
          popupContent.style.top = "50%";
          popupContent.style.transform = "translate(-50%, -50%)";
          break;
        default:
          popupContent.style.top = "30%"; // Position par défaut pour les autres pop-ups
      }

      popupContent.style.left = "50%";
      popupContent.style.transform = popupId === "popup4" ? "translate(-50%, -50%)" : "translate(-50%, 0)";

      // Affiche la pop-up
      popup.classList.add("active");
    }
  });
});

// Fermer la pop-up
document.querySelectorAll(".close").forEach((closeButton) => {
  closeButton.addEventListener("click", () => {
    const popup = closeButton.closest(".popup");
    if (popup) {
      popup.classList.remove("active");
    }
  });
});

//tarte au citron
document.addEventListener("DOMContentLoaded", function () {
  if (typeof tarteaucitron !== "undefined") {
      tarteaucitron.init({
          privacyUrl: "/politique-de-confidentialite", // URL de votre politique de confidentialité
          highPrivacy: true, // Active une haute confidentialité
          googleConsentMode: true // Mode de consentement pour Google
      });

      console.log("Tarteaucitron est initialisé !");
  } else {
      console.error("Tarteaucitron n'est pas chargé !");
  }
});
