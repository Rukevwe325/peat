(() => {
    const button = document.querySelector('.site-menu-button');
    const nav = document.getElementById('site-navigation');
    if (!button || !nav) return;
    document.documentElement.classList.add('site-js');
    const setOpen = open => {
        button.setAttribute('aria-expanded', String(open));
        nav.classList.toggle('is-open', open);
    };
    button.addEventListener('click', () => setOpen(button.getAttribute('aria-expanded') !== 'true'));
    nav.addEventListener('click', event => { if (event.target.closest('a')) setOpen(false); });
    document.addEventListener('keydown', event => {
        if (event.key !== 'Escape') return;
        const account = nav.querySelector('details[open]');
        if (account) { account.open = false; account.querySelector('summary').focus(); }
        else if (button.getAttribute('aria-expanded') === 'true') { setOpen(false); button.focus(); }
    });
})();
