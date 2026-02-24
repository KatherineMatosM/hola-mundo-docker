document.addEventListener('DOMContentLoaded', () => {

    const cards = document.querySelectorAll('.card');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => observer.observe(card));

    const updateClock = () => {
        const codeEls = document.querySelectorAll('.info-list code');
        codeEls.forEach(el => {
            if (/^\d{2}:\d{2}:\d{2}$/.test(el.textContent)) {
                el.textContent = new Date().toLocaleTimeString('es-MX', { hour12: false });
            }
        });
    };
    setInterval(updateClock, 1000);

    console.log('%c Hola Mundo Docker App ', 'background:#fe3781;color:#fff;padding:4px 10px;border-radius:4px;font-weight:bold;');
    console.log('Stack: PHP + MySQL + Docker Compose');
});