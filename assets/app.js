import"./bootstrap.js";
import"./styles/app.css";
import "./bootstrap.js";
import"bootstrap";console.log("This log comes from assets/app.js - welcome to AssetMapper! \uD83C\uDF89"),

 
        document.addEventListener("DOMContentLoaded",function(){let e=document.getElementById("scrollToTopBtn");e.addEventListener("click",function(){window.scrollTo({top:0,behavior:"smooth"})})}),document.querySelectorAll(".content-link").forEach(e=>{e.addEventListener("click",()=>{let t=e.getAttribute("data-popup"),o=document.getElementById(t);if(o){let s=o.querySelector(".popup-content");switch(t){case"popup1":s.style.top="10%";break;case"popup2":s.style.top="20%";break;case"popup3":s.style.top="35%";break;case"popup4":s.style.top="50%",s.style.transform="translate(-50%, -50%)";break;default:s.style.top="30%"}s.style.left="50%",s.style.transform="popup4"===t?"translate(-50%, -50%)":"translate(-50%, 0)",o.classList.add("active")}})}),document.querySelectorAll(".close").forEach(e=>{e.addEventListener("click",()=>{let t=e.closest(".popup");t&&t.classList.remove("active")})});
document.addEventListener("DOMContentLoaded", function() {
    let videoNavbar = document.getElementById("logo-video-navbar");
    let videoFooter = document.getElementById("logo-video-footer");
    let fallbackNavbar = document.getElementById("fallback-image-navbar");
    let fallbackFooter = document.getElementById("fallback-image-footer");

    let isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    console.log("🔍 Détection Safari :", isSafari);

    if (isSafari) {
        if (videoNavbar) videoNavbar.style.display = "none";
        if (fallbackNavbar) fallbackNavbar.style.display = "block";

        if (videoFooter) videoFooter.style.display = "none";
        if (fallbackFooter) fallbackFooter.style.display = "block";
    }
});



