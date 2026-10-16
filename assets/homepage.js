(() => {
    document.documentElement.classList.add('home-js');
    const button = document.querySelector('.home-menu-button');
    const nav = document.getElementById('home-navigation');
    const close = () => {
        button.setAttribute('aria-expanded', 'false');
        nav.classList.remove('is-open');
    };
    button.addEventListener('click', () => {
        const open = button.getAttribute('aria-expanded') !== 'true';
        button.setAttribute('aria-expanded', String(open));
        nav.classList.toggle('is-open', open);
    });
    nav.addEventListener('click', event => { if (event.target.closest('a')) close(); });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') {
            close();
            button.focus();
        }
    });
})();
