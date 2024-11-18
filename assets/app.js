import './bootstrap.js';
import './styles/app.css';
import "bootstrap/dist/css/bootstrap.min.css";
import 'bootstrap';
import './js/cookieconsent.min.js';  // Assurez-vous que ce fichier est importé avant l'initialisation
import './styles/cookieconsent.min.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

window.addEventListener("load", function () {
    setTimeout(function() {
        console.log('Cookie consent script loaded');
        if (window.cookieconsent) {
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#000"
                    },
                    "button": {
                        "background": "#85d468",
                        "text": "#f5f5e9"
                    }
                },
                "theme": "classic",
                "type": "opt-out",
                "content": {
                    "message": "Ce site utilise des cookies pour vous garantir la meilleure expérience sur notre site.",
                    "dismiss": "Accepter",
                    "deny": "Refuser",
                    "link": "En savoir plus",
                    "href": "/politique-de-cookies"
                },
                onStatusChange: function(status) {
                    if (status === 'allow') {
                        fetch('/set-cookie-consent', { method: 'GET' })
                            .then(response => response.text())
                            .then(data => {
                                console.log(data);
                            })
                            .catch(error => {
                                console.error('Error setting cookie consent:', error);
                            });
                    }
                }
            });
        } else {
            console.error("cookieconsent is not defined.");
        }
    }
    , 1000);
}
, false);


