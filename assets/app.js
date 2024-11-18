import './bootstrap.js';
import './styles/app.css';
import "bootstrap/dist/css/bootstrap.min.css";
import 'bootstrap';
import './js/cookieconsent.min.js';
import './styles/cookieconsent.min.css';


console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (
        value || ""
    ) + expires + "; path=/; SameSite=None; Secure";
}

window.addEventListener('load', function () {
    console.log('Initialisation de CookieConsent');
    if (window.cookieconsent) {
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#000"
                },
                "button": {
                    "background": "#85d468 ",
                    "text": "#f5f5e9"
                }
            },
            "theme": "classic",
            "type": "opt-out",
            "content": {
                "message": "Nous utilisons des cookies pour améliorer votre expérience sur notre site.",
                "dismiss": "Accepter",
                "deny": "Refuser",
                "link": "En savoir plus",
                "href": "/politique-de-confidentialite"
            },
            onStatusChange: function (status) {
                setCookie('cookieconsent_status', status, 365);
            },
            onInitialise: function () {
                // Ajouter une classe personnalisée au bouton "Accepter"
                const acceptBtn = document.querySelector('.cc-btn.cc-dismiss');
                if (acceptBtn) {
                    acceptBtn.classList.add('custom-accept-btn');
                }
            }
        });
    } else {
        console.error('CookieConsent library not loaded.');
    }
});

