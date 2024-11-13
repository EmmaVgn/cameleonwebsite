// blog page
document.addEventListener("DOMContentLoaded", function() {
    const articles = document.querySelectorAll('.card');
  
    articles.forEach((article, index) => {
        article.style.opacity = 0;
        article.style.transform = 'translateY(20px)';
        article.style.transition = 'opacity 0.5s ease, transform 0.5s ease'; // Ajout de la transition ici
  
        setTimeout(() => {
            article.style.opacity = 1;
            article.style.transform = 'translateY(0)';
        }, index * 100);
    });
});  