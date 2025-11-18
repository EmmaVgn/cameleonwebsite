document.addEventListener('DOMContentLoaded', () => {
  // Reveal on scroll
  const io = new IntersectionObserver((entries, obs) => {
    entries.forEach(e => {
      if(e.isIntersecting){ e.target.classList.add('is-visible'); obs.unobserve(e.target); }
    });
  }, { threshold: 0.15 });
  document.querySelectorAll('.service-card').forEach(el => io.observe(el));

  // Popups open/close (accessibles)
  let lastFocused = null;
  function openPopup(id){
    const popup = document.getElementById(id);
    if(!popup) return;
    lastFocused = document.activeElement;
    popup.setAttribute('aria-hidden','false');
    document.body.classList.add('popup-open');
    const closeBtn = popup.querySelector('.close');
    if(closeBtn) closeBtn.focus();
  }
  function closePopup(popup){
    popup.setAttribute('aria-hidden','true');
    document.body.classList.remove('popup-open');
    if(lastFocused) lastFocused.focus();
  }

  document.querySelectorAll('[data-open]').forEach(btn => {
    btn.addEventListener('click', () => openPopup(btn.getAttribute('data-open')));
  });
  document.querySelectorAll('.popup').forEach(popup => {
    popup.addEventListener('click', (e) => { if(e.target === popup) closePopup(popup); });
    const closeBtn = popup.querySelector('.close');
    if(closeBtn) closeBtn.addEventListener('click', () => closePopup(popup));
  });
  document.addEventListener('keydown', (e) => {
    if(e.key === 'Escape'){
      const opened = document.querySelector('.popup[aria-hidden="false"]');
      if(opened) closePopup(opened);
    }
  });
});
